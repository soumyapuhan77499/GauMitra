<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Models\LoginOtp;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class OtpAuthController extends Controller
{
    private function normalizePhone(string $phone): string
    {
        return preg_replace('/\D/', '', $phone);
    }

    public function sendOtp(Request $request)
    {
        $request->validate([
            'phone' => ['required', 'string', 'min:10', 'max:15'],
        ]);

        $phone = $this->normalizePhone($request->phone);
        $otp = (string) random_int(100000, 999999);

        // remove old OTPs for this phone
        LoginOtp::where('phone', $phone)->delete();

        LoginOtp::create([
            'phone' => $phone,
            'otp_hash' => Hash::make($otp),
            'expires_at' => now()->addMinutes(5),
            'is_used' => false,
        ]);

        // TODO: integrate SMS provider here
        // Example: MSG91 / Twilio / Fast2SMS

        $response = [
            'status' => true,
            'message' => 'OTP sent successfully.',
        ];

        // only for local testing
        if (app()->environment('local')) {
            $response['otp'] = $otp;
        }

        return response()->json($response, 200);
    }

    public function verifyOtp(Request $request)
    {
        $request->validate([
            'phone' => ['required', 'string', 'min:10', 'max:15'],
            'otp' => ['required', 'digits:6'],
        ]);

        $phone = $this->normalizePhone($request->phone);

        $otpRow = LoginOtp::where('phone', $phone)
            ->where('is_used', false)
            ->latest()
            ->first();

        if (! $otpRow) {
            return response()->json([
                'status' => false,
                'message' => 'OTP not found.',
            ], 404);
        }

        if (now()->gt($otpRow->expires_at)) {
            return response()->json([
                'status' => false,
                'message' => 'OTP expired.',
            ], 422);
        }

        if (! Hash::check($request->otp, $otpRow->otp_hash)) {
            return response()->json([
                'status' => false,
                'message' => 'Invalid OTP.',
            ], 422);
        }

        $otpRow->update([
            'is_used' => true,
        ]);

        $user = User::firstOrCreate(
            ['phone' => $phone],
            [
                'name' => null,
                'email' => null,
                'password' => null,
            ]
        );

        // delete old tokens if you want single device login
        $user->tokens()->delete();

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'status' => true,
            'message' => 'Login successful.',
            'token' => $token,
            'user' => $user,
        ], 200);
    }

    public function me(Request $request)
    {
        return response()->json([
            'status' => true,
            'user' => $request->user(),
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'status' => true,
            'message' => 'Logged out successfully.',
        ]);
    }
}
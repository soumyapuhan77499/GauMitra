<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\LoginOtp;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class AuthController extends Controller
{
    
    public function sendOtp(Request $request)
    {
        try {
            $request->validate([
                'mobile' => 'required|digits:10',
            ], [
                'mobile.required' => 'Mobile number is required',
                'mobile.digits'   => 'Mobile number must be 10 digits',
            ]);

            $user = User::where('mobile', $request->mobile)
                ->where('status', 'active')
                ->first();

            if (!$user) {
                return response()->json([
                    'status' => false,
                    'message' => 'User not found or inactive',
                ], 404);
            }

            $otp = substr($request->mobile, -4);

            // Mark old OTPs as used
            LoginOtp::where('mobile', $request->mobile)
                ->where('purpose', 'login')
                ->where('is_used', '0')
                ->update([
                    'is_used' => '1',
                ]);

            // Save new OTP record
            $loginOtp = LoginOtp::create([
                'user_id'    => (string) $user->id,
                'mobile'     => $request->mobile,
                'purpose'    => 'login',
                'otp_hash'   => $otp, // temporary plain OTP for testing
                'expires_at' => now()->addMinutes(5)->toDateTimeString(),
                'verified_at'=> null,
                'is_used'    => '0',
                'attempts'   => '0',
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
            ]);

            return response()->json([
                'status' => true,
                'message' => 'OTP sent successfully',
                'data' => [
                    'mobile' => $request->mobile,
                    'otp' => $otp,
                    'expires_at' => $loginOtp->expires_at,
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Server error',
                'error' => $e->getMessage(),
                'line' => $e->getLine(),
                'file' => $e->getFile(),
            ], 500);
        }
    }

    /**
     * Verify OTP and login
     */
    public function verifyOtp(Request $request)
    {
        try {
            $request->validate([
                'mobile' => 'required|digits:10',
                'otp'    => 'required|digits:4',
            ], [
                'mobile.required' => 'Mobile number is required',
                'mobile.digits'   => 'Mobile number must be 10 digits',
                'otp.required'    => 'OTP is required',
                'otp.digits'      => 'OTP must be 4 digits',
            ]);

            $user = User::where('mobile', $request->mobile)
                ->where('status', 'active')
                ->first();

            if (!$user) {
                return response()->json([
                    'status' => false,
                    'message' => 'User not found or inactive',
                ], 404);
            }

            $loginOtp = LoginOtp::where('mobile', $request->mobile)
                ->where('purpose', 'login')
                ->where('otp_hash', $request->otp)
                ->where('is_used', '0')
                ->latest()
                ->first();

            if (!$loginOtp) {
                return response()->json([
                    'status' => false,
                    'message' => 'Invalid OTP',
                ], 401);
            }

            if (!empty($loginOtp->expires_at) && Carbon::parse($loginOtp->expires_at)->isPast()) {
                return response()->json([
                    'status' => false,
                    'message' => 'OTP expired',
                ], 401);
            }

            $loginOtp->update([
                'is_used' => '1',
                'verified_at' => now()->toDateTimeString(),
            ]);

            $user->update([
                'mobile_verified_at' => now()->toDateTimeString(),
                'last_login_at'      => now()->toDateTimeString(),
            ]);

            $token = $user->createToken('mobile-login-token')->plainTextToken;

            return response()->json([
                'status' => true,
                'message' => 'Login successful',
                'token' => $token,
                'token_type' => 'Bearer',
                'user' => $user,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Server error',
                'error' => $e->getMessage(),
                'line' => $e->getLine(),
                'file' => $e->getFile(),
            ], 500);
        }
    }

    /**
     * Logout
     */
    public function logout(Request $request)
    {
        try {
            $request->user()->currentAccessToken()->delete();

            return response()->json([
                'status' => true,
                'message' => 'Logout successful',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Server error',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
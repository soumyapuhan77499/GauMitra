<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserAddressController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id'          => 'required|exists:users,id',
            'full_address'     => 'required|string',
            'street'           => 'nullable|string|max:255',
            'village'          => 'nullable|string|max:150',
            'police_station'   => 'nullable|string|max:150',
            'city'             => 'nullable|string|max:150',
            'district'         => 'nullable|string|max:150',
            'state'            => 'nullable|string|max:150',
            'pincode'          => 'nullable|string|max:20',
            'area_name'        => 'nullable|string|max:150',
            'latitude'         => 'required|numeric|between:-90,90',
            'longitude'        => 'required|numeric|between:-180,180',
            'google_place_id'  => 'nullable|string|max:255',
            'plus_code'        => 'nullable|string|max:100',
        ], [
            'user_id.required'      => 'User ID is required.',
            'user_id.exists'        => 'Selected user does not exist.',
            'full_address.required' => 'Full address is required.',
            'latitude.required'     => 'Latitude is required.',
            'longitude.required'    => 'Longitude is required.',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status'  => false,
                'message' => 'Validation error.',
                'errors'  => $validator->errors(),
            ], 422);
        }

        $address = UserAddress::create([
            'user_id'         => $request->user_id,
            'full_address'    => $request->full_address,
            'street'          => $request->street,
            'village'         => $request->village,
            'police_station'  => $request->police_station,
            'city'            => $request->city,
            'district'        => $request->district,
            'state'           => $request->state,
            'pincode'         => $request->pincode,
            'area_name'       => $request->area_name,
            'latitude'        => $request->latitude,
            'longitude'       => $request->longitude,
            'google_place_id' => $request->google_place_id,
            'plus_code'       => $request->plus_code,
        ]);

        return response()->json([
            'status'  => true,
            'message' => 'Address saved successfully.',
            'data'    => $address,
        ], 201);
    }
}
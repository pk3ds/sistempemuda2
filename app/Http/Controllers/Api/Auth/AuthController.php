<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function signin(Request $request) {
        try {
            $validatedUser = Validator::make($request->all(),
            [
                'staff_id' => 'required',
                'password' => 'required',
            ]);

            if ($validatedUser->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $validatedUser->errors()
                ], 422);
            }

            if (!Auth::attempt($request->only(['staff_id', 'password']))) {
                return response()->json([
                    'status' => false,
                    'message' => 'Staff id & Password does not match with our record.',
                ], 422);
            }

            $user = User::where('staff_id', $request->staff_id)->first();
            return response()->json([
                'status' => true,
                'message' => 'User Login Successfully',
                'token' => $user->createToken("API TOKEN")->plainTextToken
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }
}

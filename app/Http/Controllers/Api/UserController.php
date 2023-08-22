<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Meeting;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index() {
        try {
            $meeting = Meeting::all();
            if ($meeting->count() > 0) {
                return response()->json([
                    'status' => 200,
                    'meeting' => $meeting
                ], 200);
            } else {
                return response()->json([
                    'status' => 404,
                    'message' => 'No records found',
                ], 404);
            }
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }
}

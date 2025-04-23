<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResources;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            return response()->json([
                'message' => 'Email atau password salah',
                'success' => false
            ], 401);
        }
        // Generate token
        // $token = $user->createToken('API Token')->plainTextToken;

        return new UserResources($user);
    }
    public function user(Request $request)
    {
        return response()->json([
            'success' => true,
            $request->user()
        ]);
    }
}

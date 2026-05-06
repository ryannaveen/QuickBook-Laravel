<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Authenticate the user and create a new API token.
     */
    public function createToken(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'device' => 'nullable|string',
        ]);

        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        $user = Auth::user();

        $abilities = $user->role === 'owner'
            ? ['services:manage', 'appointments:read']
            : ['appointments:create', 'appointments:read'];

        $token = $user->createToken($request->device ?? 'api-token', $abilities);

        return response()->json([
            'token' => $token->plainTextToken,
            'role' => $user->role,
            'name' => $user->name,
            'abilities' => $abilities,
        ]);
    }

    /**
     * Revoke the current access token.
     */
    public function revokeToken(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Token revoked successfully'
        ]);
    }
}

<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth as Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }

    public function login(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');
        $user = User::where('email', $credentials['email'])->first();

        if (!$user) {
            return response()->json([
                'error' => 'Email không tồn tại',
            ], 401);
        }
        if (!Hash::check($credentials['password'], $user->password)) {
            return response()->json([
                'error' => 'Mật khẩu không chính xác'
            ], 401);
        }

        $token = Auth::attempt($credentials);
        $role = Auth::user()->role;
        return response()->json([
            'token'=>$token,
            'role'=>$role
        ],200);
    }

    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    public function refresh()
    {
        return $this->respondWithToken(Auth::refresh());
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => Auth::factory()->getTTL() * 60
        ]);
    }
}

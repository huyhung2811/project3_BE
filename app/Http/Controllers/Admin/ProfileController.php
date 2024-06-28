<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth as Auth;

class ProfileController extends Controller
{
    public function profile()
    {
        $user = Auth::user();

        $data = [ 
            'name' => "Admin",
            'email' => $user->email,
            'avatar' => asset("assets/images/default_avatar.jpg"),
        ];

        return response()->json($data, 200);
    }
}

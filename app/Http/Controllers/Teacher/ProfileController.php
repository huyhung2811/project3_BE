<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth as Auth;
use App\Models\Unit;

class ProfileController extends Controller
{
    public function profile(){
        $user = Auth::user();   
        $profile = $user->teachers[0];
        return response()->json([
            'teacher_code'=>$profile->teacher_code,
            'name' => $profile->name,
            'email' => $profile->email,
            'unit' => $profile->unit->name,
            'avatar' => $profile->avatar == null || $profile->avatar == '' ? asset('assets/images/default_avatar.jpg') : $profile->avatar
        ]);
    }
    
    public function update(){

    }
}

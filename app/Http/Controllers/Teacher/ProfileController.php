<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\DayOffRequest;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth as Auth;
use App\Models\Unit;
use App\Models\StudentsClasses;

class ProfileController extends Controller
{
    public function profile()
    {
        $user = Auth::user();
        $profile = $user->teachers[0];
        $student_classes = [];
        foreach ($profile->course_classes as $course_class){
            $student_classes[] = StudentsClasses::where('class_code', $course_class->class_code)->get();
        }
        $notifications = 0;
        foreach ($student_classes as $student_class) {
            $requests = DayOffRequest::where('student_class_id', $student_class[0]->id)->get();
            foreach ($requests as $request) {
                if ($request->is_read === "0") {
                    $notifications++;
                }
            }
        }

        return response()->json([
            'teacher_code' => $profile->teacher_code,
            'name' => $profile->name,
            'email' => $profile->email,
            'unit' => $profile->unit->name,
            'avatar' => $profile->avatar,
            'notifications' => $notifications
        ]);
    }

    public function update()
    {
    }
}

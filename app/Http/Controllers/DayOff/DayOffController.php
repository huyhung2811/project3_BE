<?php

namespace App\Http\Controllers\DayOff;

use App\Http\Controllers\Controller;
use App\Models\CourseClass;
use Illuminate\Http\Request;
use App\Models\DayOffRequest;
use App\Models\StudentsClasses;
use Illuminate\Support\Carbon;
use Tymon\JWTAuth\Facades\JWTAuth as Auth;

class DayOffController extends Controller
{
    public function storeDayOffRequest(Request $request)
    {
        $createTime = Carbon::now()->format('H:i:s');
        $createDay = Carbon::now()->format('Y-m-d');
        $student = Auth::user()->students->first();
        $student_class_id = StudentsClasses::where('student_code', $student->student_code)
            ->where('class_code', $request->class_code)->first()->id;
        $store = DayOffRequest::create([
            'student_class_id' => $student_class_id,
            'day' => $request->day,
            'created_day' => $createDay,
            'created_time' => $createTime,
            'reason' => $request->reason,
        ]);

        return response()->json([
            'message' => 'Tạo yêu cầu thành công!',
        ], 200);
    }
}

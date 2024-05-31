<?php

namespace App\Http\Controllers\Attendance;

use App\Http\Controllers\Controller;
use App\Models\StudentsClasses;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\CourseClass;

class AttendanceController extends Controller
{
    public function makeAttendance(Request $request)
    {
    }

    public function showClassAttendance(Request $request)
    {
        $class_code = $request->class_code;
        $day = $request->day ? $request->day : Carbon::today()->toDateString();
        $attendances = [];
        $course_class = CourseClass::where('class_code', $class_code)->first();
        foreach ($course_class->students as $student) {
            $attendance = StudentsClasses::where('class_code', $class_code)
                ->where('student_code', $student->student_code)
                ->first()
                ->attendances;
            $attendance_by_day = $attendance->where('day', $day);
            $attendances[] = [
                'student' => $student,
                'attendance' => $attendance_by_day,
            ];
        }

        return response()->json([
            'attendances' => $attendances,
        ]);
    }

    public function editStudentAttendance(Request $request)
    {
    }
}

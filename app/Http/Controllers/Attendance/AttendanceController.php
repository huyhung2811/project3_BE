<?php

namespace App\Http\Controllers\Attendance;

use App\Http\Controllers\Controller;
use App\Models\StudentsClasses;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\CourseClass;
use App\Models\StudentAttendance;
use PhpParser\Node\Expr\Empty_;

class AttendanceController extends Controller
{
    public function showClassAttendance(Request $request)
    {
        $class_code = $request->class_code;
        $day = $request->day;
        if (Carbon::parse($day)->gt(Carbon::today())) {
            return response()->json([
                'message' => "Không tồn tại điểm danh",
            ], 404);
        }
        $attendances = [];
        $course_class = CourseClass::where('class_code', $class_code)->first();
        foreach ($course_class->students as $student) {
            $attendance = StudentsClasses::where('class_code', $class_code)
                ->where('student_code', $student->student_code)
                ->first()
                ->student_attendances;
            if ($attendance) {
                $attendance_by_day = $attendance->where('day', $day)->first();
                if ($attendance_by_day) {
                    $attendances[] = [
                        'student' => $student,
                        'class_attendance' => $attendance_by_day,
                    ];
                }
            }
        }

        if (!$attendances) {
            return response()->json([
                'message' => "Không tồn tại điểm danh",
            ], 404);
        }

        return response()->json([
            'attendances' => $attendances,
        ], 200);
    }

    public function updateStudentAttendance(Request $request)
    {
        $student_attendance_id = (int) $request->attendance_id;
        $status = $request->status;

        $updated = StudentAttendance::where('id', $student_attendance_id)
            ->update(['status' => $status]);

        if ($updated) {
            return response()->json([
                'message' => 'Cập nhật thành công'
            ], 200);
        } else {
            return response()->json([
                'message' => 'Cập nhật thất bại'
            ], 404);
        }
    }
}

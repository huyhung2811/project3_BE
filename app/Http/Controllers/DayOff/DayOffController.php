<?php

namespace App\Http\Controllers\DayOff;

use App\Events\DayOffRequestPusher;
use App\Events\DayOffResponsePusher;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DayOffRequest;
use App\Models\StudentsClasses;
use App\Models\CourseClass;
use Illuminate\Support\Carbon;
use Tymon\JWTAuth\Facades\JWTAuth as Auth;
use App\Models\StudentAttendance;

class DayOffController extends Controller
{
    public function storeDayOffRequest(Request $request)
    {
        $createTime = Carbon::now();
        $student = Auth::user()->students->first();
        $student_class_id = StudentsClasses::where('student_code', $student->student_code)
            ->where('class_code', $request->class_code)->first()->id;
        if (DayOffRequest::where('student_class_id', $student_class_id)->where('day', $request->day)->first()) {
            return response()->json([
                'message' => 'Đã tồn tại yêu cầu',
            ], 422);
        }

        if (Carbon::parse($request->day)->lt(Carbon::today())) {
            return response()->json([
                'message' => 'Ngày nghỉ không hợp lệ, đã quá thời gian!',
            ], 422);
        }

        $store = DayOffRequest::create([
            'student_class_id' => $student_class_id,
            'day' => $request->day,
            'created_time' => $createTime,
            'updated_time' => $createTime,
            'reason' => $request->reason,
            'status' => "Chờ duyệt",
            'is_read' => "0",
        ]);

        if ($store) {
            event(new DayOffRequestPusher('Success'));
            return response()->json([
                'message' => 'Tạo yêu cầu thành công!',
            ], 200);
        }
    }

    public function showDayOffRequest()
    {
        $user = Auth::user();
        if ($user->role == 'teacher') {
            $teacher = Auth::user()->teachers->first();
            $course_classes = $teacher->course_classes;
        }

        if ($user->role == 'student') {
            $student = Auth::user()->students->first();
            $course_classes = $student->course_classes;
        }

        $student_classes = [];
        foreach ($course_classes as $course_class) {
            $student_classes[] = StudentsClasses::where('class_code', $course_class->class_code)->first();
        }
        $dayOffRequest = [];
        foreach ($student_classes as $student_class) {
            $class_requests = DayOffRequest::where('student_class_id', $student_class->id)->orderBy('created_time', 'desc')->get();
            foreach ($class_requests as $class_request) {
                $course_class = $class_request->students_classes->courseClass;
                $createdTime = Carbon::parse($class_request->created_day . ' ' . $class_request->created_time);
                $elapsedTime = $createdTime->locale('vi')->diffForHumans();
                $dayOffRequest[] = [
                    'id' => $class_request->id,
                    'student_name' => $student_class->student->name,
                    'student_avatar' => $student_class->student->avatar,
                    'class_code' => $course_class->class_code,
                    'class_name' => $course_class->course->name,
                    'day' => $class_request->day,
                    'created_time' => $class_request->created_time,
                    'elapsed_time' => $elapsedTime,
                    'reason' => $class_request->reason,
                    'status' => $class_request->status,
                    'is_read' => $class_request->is_read,
                ];
            }
        }

        usort($dayOffRequest, function ($a, $b) {
            return strtotime($b['created_time']) - strtotime($a['created_time']);
        });

        return response()->json([
            'day_off_request' => $dayOffRequest,
        ]);
    }

    public function changeIsReadRequest(Request $request)
    {
        $id = $request->request_id;
        if (Auth::user()->role == "teacher") {
            $is_changed = DayOffRequest::where('id', $id)->update(['is_read' => '1']);
            if ($is_changed) {
                return response()->json([
                    'message' => 'Đã xem',
                ], 200);
            }
        }
    }

    public function showRequestDetails(Request $request)
    {
        $id = $request->request_id;
        $details = DayOffRequest::where('id', $id)->first();
        $student = $details->students_classes->student;
        $course_class = $details->students_classes->courseClass;
        $teacher = $details->students_classes->courseClass->teacher;
        $data = [
            'id' => $details->id,
            'student_name' => $student->name,
            'student_code' => $student->student_code,
            'student_avatar' => $student->avatar,
            'class_name' => $course_class->course->name,
            'class_code' => $course_class->class_code,
            'course_code' => $course_class->course_code,
            'start_time' => $course_class->start_time,
            'end_time' => $course_class->end_time,
            'teacher_name' => $teacher->name,
            'teacher_code' => $teacher->teacher_code,
            'teacher_avatar' => $teacher->avatar,
            'day' => $details->day,
            'created_time' => $details->created_time,
            'updated_time' => $details->updated_time,
            'reason' => $details->reason,
            'status' => $details->status,
        ];
        return response()->json([
            'request_details' => $data,
        ], 200);
    }

    public function updateRequestStatus(Request $request)
    {
        $id = $request->request_id;
        $updateTime = Carbon::now();

        $details = DayOffRequest::where('id', $id)->first();
        if (!$details) {
            return response()->json([
                'message' => 'Request not found',
            ], 404);
        }

        $details->status = $request->status;
        $details->updated_time = $updateTime;

        if ($details->save()) {
            if ($request->status == "Duyệt") {
                $attendance = StudentAttendance::where('student_class_id', $details->student_class_id)
                    ->where('day', $details->day)
                    ->first();
                if ($attendance) {
                    $attendance->status = "Nghỉ có phép";
                    $attendance->save();
                }
                event(new DayOffResponsePusher('Duyệt'));
            } elseif ($request->status == "Từ chối") {
                event(new DayOffResponsePusher('Từ chối'));
            }

            return response()->json([
                'message' => 'Success',
            ], 200);
        } else {
            return response()->json([
                'message' => 'Failed to update status',
            ], 500);
        }
    }
}

<?php

namespace App\Http\Controllers\Student;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\AttendanceTime;
use App\Models\CourseClass;
use App\Models\StudentsClasses;
use Tymon\JWTAuth\Facades\JWTAuth as Auth;
use App\Models\EducationalSystem;
use App\Models\Semester;
use Illuminate\Support\Carbon;
use App\Models\Holiday;
use App\Models\StudentAttendance;


class StudentController extends Controller
{
    public function showSchedule()
    {
        $user = Auth::user();
        $student = $user->students[0];
        $class = $student->class;
        $system = EducationalSystem::find($class->system_id);
        $schedules = [];
        $course_classes = $student->course_classes;
        foreach ($course_classes as $course_class) {
            $course = $course_class->course;
            $schedules[] = [
                'class_code' => $course_class->class_code,
                'course_code' => $course_class->course_code,
                'course_name' => $course->name,
                'semester' => $course_class->semester->semester,
                'room' => $course_class->room,
                'education_format' => $course_class->education_format,
                'class_type' => $course_class->class_type,
                'teacher_name' => $course_class->teacher->name,
                'school_day' => $course_class->school_day,
                'start_time' => $course_class->start_time,
                'end_time' => $course_class->end_time,
                'description' => $course_class->description,
            ];
        }
        return response()->json([
            'schedule' => $schedules,
        ]);
    }

    public function showCourseClass(Request $request)
    {
        $user = Auth::user();
        $student = $user->students[0];
        $currentDate = $request->date;
        $currentSemester = Semester::where('start_date', '<=', $currentDate)
            ->where('end_date', '>=', $currentDate)
            ->first();
        $course_classes = $student->course_classes->where('semester_id', $currentSemester->id);
        $classes = [];
        foreach ($course_classes as $course_class) {
            $course = $course_class->course;
            $classes[] = [
                'class_code' => $course_class->class_code,
                'name' => $course->name,
                'semester_id' => $course_class->semester_id,
                'course_code' => $course_class->course_code,
                'teacher_code' => $course_class->teacher_code,
                'room' => $course_class->room,
                'education_format' => $course_class->education_format,
                'description' => $course_class->description,
                'class_type' => $course_class->class_type,
                'school_day' => $course_class->school_day,
                'start_time' => $course_class->start_time,
                'end_time' => $course_class->end_time,
            ];
        }

        return response()->json([
            'course_classes' => $classes,
        ]);
    }

    function showStudentClass()
    {
        $user = Auth::user();
        $student = $user->students[0];
        $class = $student->class;
        return response()->json([
            'class_id' => $class->id,
            'class_name' => $class->name,
            'unit' => $class->unit->name,
            'system' => $class->system->name,
            'students' => $class->students
        ]);
    }

    function showScheduleInDay(Request $request)
    {
        $weekMap = [
            0 => 'Sunday',
            1 => 'Monday',
            2 => 'Tuesday',
            3 => 'Wednesday',
            4 => 'Thursday',
            5 => 'Friday',
            6 => 'Saturday',
        ];
        $currentDate = $request->date;
        $user = Auth::user();
        $student = $user->students[0];
        $currentSemester = Semester::where('start_date', '<=', $currentDate)
            ->where('end_date', '>=', $currentDate)
            ->get();

        $dayOfTheWeek = Carbon::parse($currentDate)->dayOfWeek;
        $weekday = $weekMap[$dayOfTheWeek];

        $holidays = Holiday::get();
        $isHoliday = false;
        $schedule = [];
        foreach ($holidays as $holiday) {
            if ($currentDate >= $holiday['start_date'] && $currentDate <= $holiday['end_date']) {
                $isHoliday = true;
                $description = $holiday['description'];
                return response()->json([
                    'is_holiday' => $isHoliday,
                    'schedule' => [],
                    'description' => $description
                ]);
            }
        }

        if ($currentSemester->isEmpty()) {
            return response()->json([
                'message' => 'Không có lịch học',
            ], 404);
        }


        $classes_in_day = $student->course_classes->where('school_day', $weekday)->where('semester_id', $currentSemester[0]->id);
        if ($classes_in_day->isEmpty()) {
            return response()->json([
                'message' => 'Không có lịch học',
            ], 404);
        }
        foreach ($classes_in_day as $course_class) {
            $course = $course_class->course;
            $schedule[] = [
                'class_code' => $course_class->class_code,
                'name' => $course->name,
                'course_code' => $course_class->course_code,
                'room' => $course_class->room,
                'school_day' => $course_class->school_day,
                'start_time' => $course_class->start_time,
                'end_time' => $course_class->end_time,
            ];
        }
        usort($schedule, function ($a, $b) {
            return strcmp($a['start_time'], $b['start_time']);
        });
        return response()->json([
            'is_holiday' => $isHoliday,
            'schedule_in_day' => $schedule,
            'description' => ''
        ]);
    }

    function showScheduleInWeek(Request $request)
    {
        $weekMap = [
            0 => 'Sunday',
            1 => 'Monday',
            2 => 'Tuesday',
            3 => 'Wednesday',
            4 => 'Thursday',
            5 => 'Friday',
            6 => 'Saturday',
        ];
        $user = Auth::user();
        $student = $user->students[0];
        $currentDate = $request->date;
        $currentDateCarbon = Carbon::parse($currentDate);

        $startOfWeek = $currentDateCarbon->startOfWeek(Carbon::MONDAY)->format('Y-m-d');
        $endOfWeek = $currentDateCarbon->endOfWeek(Carbon::SUNDAY)->format('Y-m-d');

        $currentSemester = Semester::where('start_date', '<=', $currentDate)
            ->where('end_date', '>=', $currentDate)
            ->first();

        $holidays = Holiday::get();
        $weekSchedule = [];

        for ($date = $startOfWeek; $date <= $endOfWeek; $date = Carbon::parse($date)->addDay()->format('Y-m-d')) {
            $dayOfTheWeek = Carbon::parse($date)->dayOfWeek;
            $weekday = $weekMap[$dayOfTheWeek];
            $isHoliday = false;
            $description = '';

            foreach ($holidays as $holiday) {
                if ($date >= $holiday['start_date'] && $date <= $holiday['end_date']) {
                    $isHoliday = true;
                    $description = $holiday['description'];
                    break;
                }
            }

            if ($isHoliday) {
                $weekSchedule[$date] = ['is_holiday' => true, 'schedule' => [], 'description' => $description];
                continue;
            }

            if (!$currentSemester) {
                $weekSchedule[$date] = ['is_holiday' => false, 'schedule' => [], 'description' => $description];
                continue;
            }

            $classes_in_day = $student->course_classes->where('school_day', $weekday)
                ->where('semester_id', $currentSemester->id);

            $dailySchedule = [];
            foreach ($classes_in_day as $course_class) {
                $course = $course_class->course;
                $dailySchedule[] = [
                    'class_code' => $course_class->class_code,
                    'name' => $course->name,
                    'course_code' => $course_class->course_code,
                    'room' => $course_class->room,
                    'school_day' => $course_class->school_day,
                    'start_time' => $course_class->start_time,
                    'end_time' => $course_class->end_time,
                ];
            }

            usort($dailySchedule, function ($a, $b) {
                return strcmp($a['start_time'], $b['start_time']);
            });

            $weekSchedule[$date] = ['is_holiday' => false, 'schedule' => $dailySchedule, 'description' => $description];
        }

        return response()->json([
            'schedule_in_week' => $weekSchedule
        ]);
    }

    function showScheduleInMonth(Request $request)
    {
        $weekMap = [
            0 => 'Sunday',
            1 => 'Monday',
            2 => 'Tuesday',
            3 => 'Wednesday',
            4 => 'Thursday',
            5 => 'Friday',
            6 => 'Saturday',
        ];

        $currentDate = $request->date;
        $currentDateCarbon = Carbon::parse($currentDate);
        $user = Auth::user();
        $student = $user->students[0];

        $startOfMonth = $currentDateCarbon->startOfMonth()->format('Y-m-d');
        $endOfMonth = $currentDateCarbon->endOfMonth()->format('Y-m-d');

        $currentSemester = Semester::where('start_date', '<=', $currentDate)
            ->where('end_date', '>=', $currentDate)
            ->first();

        $holidays = Holiday::get();
        $monthSchedule = [];

        for ($date = $startOfMonth; $date <= $endOfMonth; $date = Carbon::parse($date)->addDay()->format('Y-m-d')) {
            $dayOfTheWeek = Carbon::parse($date)->dayOfWeek;
            $weekday = $weekMap[$dayOfTheWeek];
            $isHoliday = false;
            $description = '';

            foreach ($holidays as $holiday) {
                if ($date >= $holiday['start_date'] && $date <= $holiday['end_date']) {
                    $isHoliday = true;
                    $description = $holiday['description'];
                    break;
                }
            }

            if ($isHoliday) {
                $monthSchedule[$date] = ['is_holiday' => true, 'schedule' => [], 'description' => $description];
                continue;
            }

            if (!$currentSemester) {
                $monthSchedule[$date] = ['is_holiday' => false, 'schedule' => [], 'description' => $description];
                continue;
            }

            $classes_in_day = $student->course_classes->where('school_day', $weekday)->where('semester_id', $currentSemester->id);
            $dailySchedule = [];
            foreach ($classes_in_day as $course_class) {
                $course = $course_class->course;
                $dailySchedule[] = [
                    'class_code' => $course_class->class_code,
                    'name' => $course->name,
                    'course_code' => $course_class->course_code,
                    'room' => $course_class->room,
                    'school_day' => $course_class->school_day,
                    'start_time' => $course_class->start_time,
                    'end_time' => $course_class->end_time,
                ];
            }

            usort($dailySchedule, function ($a, $b) {
                return strcmp($a['start_time'], $b['start_time']);
            });

            $monthSchedule[$date] = ['is_holiday' => false, 'schedule' => $dailySchedule, 'description' => $description];
        }

        return response()->json([
            'schedule_in_month' => $monthSchedule
        ]);
    }

    function createDayAttendance(Request $request)
    {
        $user = Auth::user();
        $student = $user->students[0];
        $class_code = $request->class_code;
        $day = $request->day;

        $students_classes = StudentsClasses::where('student_code', $student->student_code)
            ->where('class_code', $class_code)
            ->get();

        $data_student_attendance = [
            'student_class_id' => $students_classes[0]->id,
            'day' => $day,
            'status' => "Vắng",
        ];

        if (StudentAttendance::create($data_student_attendance)) {
            return response()->json([
                "message" => "Thêm điểm danh thành công",
            ]);
        }
    }

    function storeAttendance(Request $request)
    {
        $user = Auth::user();
        $student = $user->students[0];
        $class_code = $request->class_code;
        $day = $request->day;
        $time = $request->time;
        $bluetooth_address = $request->bluetooth_address;
        $type = $request->type;

        $students_classes = StudentsClasses::where('student_code', $student->student_code)
            ->where('class_code', $class_code)
            ->get();
        $student_attendance_id = StudentAttendance::where('student_class_id', $students_classes[0]->id)
            ->where('day', $day)->first()->id;

        if ($type == "start_time") {
            $course_class = CourseClass::where('class_code', $class_code)->first();
            $start_time = Carbon::parse($course_class->start_time);
            $input_time = Carbon::parse($time);
            $time_diff = $input_time->diffInMinutes($start_time);
            if ($time_diff < 5) {
                $status = 'Đi học';
            } elseif ($time_diff >= 5 && $time_diff < 15) {
                $status = 'Đi muộn';
            } else {
                $status = 'Vắng';
            }
            $data_attendance_time = [
                'student_attendance_id' => $student_attendance_id,
                'day' => $day,
                'time' => $time,
                'bluetooth_address' => $bluetooth_address,
                'type' => $request->type,
            ];

            if (AttendanceTime::insert($data_attendance_time)) {
                StudentAttendance::where('id', $student_attendance_id)->update(['status' => $status]);
                return response()->json([
                    'message' => 'Điểm danh thành công',
                ], 200);
            } else {
                return response()->json([
                    'message' => 'Điểm danh thất bại',
                ], 422);
            }
        } else if ($type == 'end_time') {
            $data_attendance_time = [
                'student_attendance_id' => $student_attendance_id,
                'day' => $day,
                'time' => $time,
                'bluetooth_address' => $bluetooth_address,
                'type' => $request->type,
            ];

            if (AttendanceTime::insert($data_attendance_time)) {
                if ($time == null) {
                    dd($time);
                    $status = "Vắng";
                    StudentAttendance::where('id', $student_attendance_id)->update(['status' => $status]);
                }
                return response()->json([
                    'message' => 'Điểm danh thành công',
                ], 200);
            } else {
                return response()->json([
                    'message' => 'Điểm danh thất bại',
                ], 422);
            }
        }
    }

    function showAttendance(Request $request)
    {
        $class_code = $request->class_code;
        $user = Auth::user();
        $student = $user->students[0];
        $attendances = StudentsClasses::where('class_code', $class_code)
            ->where('student_code', $student->student_code)
            ->first()->student_attendances;
        if ($attendances->isEmpty()) {
            return response()->json([
                "message" => "Không tồn tại điểm danh",
            ], 404);
        }
        $data = [];
        foreach ($attendances as $attendance) {
            $data[] = [
                'id' => $attendance->id,
                'day' => $attendance->day,
                'status' => $attendance->status,
                'start_time' => $attendance->attendance_times->where('type', 'start_time')->first()->time ?? null,
                'end_time' => $attendance->attendance_times->where('type', 'end_time')->first()->time ?? null,
            ];
        }
        return response()->json([
            "attendances" => $data,
        ], 200);
    }

    function showAttendanceByDay(Request $request)
    {
        $class_code = $request->class_code;
        $day = $request->day ? $request->day : Carbon::today()->toDateString();
        $user = Auth::user();
        $student = $user->students[0];
        $attendance = StudentsClasses::where('class_code', $class_code)
            ->where('student_code', $student->student_code)
            ->first()->student_attendances;
        if ($attendance->isEmpty()) {
            return response()->json([
                "message" => "Không tồn tại điểm danh",
            ], 404);
        }
        $data = [];
        $attendance_by_day = $attendance->where('day', $day)->first();
        $data[] = [
            'id' => $attendance_by_day->id,
            'day' => $attendance_by_day->day,
            'status' => $attendance_by_day->status,
            'start_time' => $attendance_by_day->attendance_times->where('type', 'start_time')->first()->time ?? null,
            'end_time' => $attendance_by_day->attendance_times->where('type', 'end_time')->first()->time ?? null,
        ];
        return response()->json([
            "attendances" => $data,
        ], 200);
    }
}

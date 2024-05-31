<?php

namespace App\Http\Controllers\Teacher;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Tymon\JWTAuth\Facades\JWTAuth as Auth;
use Illuminate\Support\Carbon;
use App\Models\Holiday;
use App\Models\Semester;
use App\Models\CourseClass;

class TeacherController extends Controller
{
    public function showSchedule()
    {
        $user = Auth::user();
        $teacher = $user->teachers[0];
        $schedules = [];
        $course_classes = $teacher->course_classes;
        foreach ($course_classes as $course_class) {
            $course = $course_class->course;
            $schedules[] = [
                'class_code' => $course_class->class_code,
                'course_code' => $course_class->course_code,
                'course_name' => $course->name,
                'semester' => $course_class->scholastic . $course_class->semester,
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
        $teacher = $user->teachers[0];

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

            $classes_in_day = CourseClass::where('school_day', $weekday)
                ->where('semester_id', $currentSemester->id)
                ->where('teacher_code', $teacher->teacher_code)
                ->get();

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
        $user = Auth::user();
        $teacher = $user->teachers[0];
        $currentDate = $request->date;
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

        $classes_in_day = CourseClass::where('school_day', $weekday)
            ->where('semester_id', $currentSemester[0]->id)
            ->where('teacher_code', $teacher->teacher_code)
            ->get();
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

    public function showCourseClass(Request $request)
    {
        $user = Auth::user();
        $teacher = $user->teachers[0];
        $currentDate = $request->date;
        $currentSemester = Semester::where('start_date', '<=', $currentDate)
            ->where('end_date', '>=', $currentDate)
            ->first();
        $course_classes = CourseClass::where('semester_id', $currentSemester->id)
            ->where('teacher_code', $teacher->teacher_code)
            ->get();

        $classes = [];
        foreach ($course_classes as $course_class) {
            $course = $course_class->course;
            $classes[] = [
                'class_code' => $course_class->class_code,
                'name' => $course->name,
                'course_code' => $course_class->course_code,
                'room' => $course_class->room,
                'school_day' => $course_class->school_day,
                'start_time' => $course_class->start_time,
                'end_time' => $course_class->end_time,
            ];
        }

        return response()->json([
            'course_classes' => $classes,
        ]);
    }
}

<?php

namespace App\Http\Controllers\Common;

use App\Http\Controllers\Controller;
use App\Models\CourseClass;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\StudentClass;
use App\Models\EducationalSystem;
use App\Models\Teacher;
use App\Models\Semester;
use App\Models\StudentsClasses;
use Tymon\JWTAuth\Facades\JWTAuth as Auth;

class CommonController extends Controller
{
    public function showClassStudents(Request $request)
    {
        $id = $request->class_id;
        $students = [];
        $student_class = StudentClass::where('id', $id)->first();
        foreach ($student_class->students as $student) {
            $students[] = [
                'student_code' => $student->student_code,
                'name' => $student->name,
                'avatar' => $student->avatar == null || $student->avatar == '' ? asset('assets/images/default_avatar.jpg') : $student->avatar,
            ];
        }

        return response()->json([
            'students' => $students,
        ]);
    }

    public function showCourseClassDetails(Request $request)
    {
        $user = Auth::user();
        $course_class = CourseClass::where('class_code', $request->class_code)
            ->get();
        $systems = [];
        foreach ($course_class[0]->course->systems as $system) {
            $systems[] = $system->system;
        }
        $students = [];
        foreach ($course_class[0]->students as $student) {
            $students[] = [
                'student_code' => $student->student_code,
                'name' => $student->name,
                'avatar' => $student->avatar == null || $student->avatar == '' ? asset('assets/images/default_avatar.jpg') : $student->avatar,
            ];
        }
        $result = [
            'class_code' => $course_class[0]->class_code,
            'course_code' => $course_class[0]->course_code,
            'name' => $course_class[0]->course->name,
            'type' => $course_class[0]->class_type,
            'systems' => $systems,
            'semester' => $course_class[0]->semester->semester,
            'education_format' => $course_class[0]->education_format,
            'teacher_name' => $course_class[0]->teacher->name,
            'school_day' => $course_class[0]->school_day,
            'start_time' => $course_class[0]->start_time,
            'end_time' => $course_class[0]->end_time,
            'room' => $course_class[0]->room,
            'students' => $students,
            'students_number' => $course_class[0]->students->count(),
            'number_of_absenses' => -1,
            'description' => $course_class[0]->description,
        ];

        if ($user->role == 'student' && $course_class[0]->students->contains('student_code', $user->students[0]->student_code)) {
            $student_code = $user->students[0]->student_code;
            $students_classes = StudentsClasses::where('student_code', $student_code)
                ->where('class_code', $request->class_code)->first();
            if (!$students_classes->student_attendances) {
                $result['number_of_absenses'] = 0;
            } else {
                $result['number_of_absenses'] = $students_classes->student_attendances->where('status', 'Vắng')->count();
            }
        }

        return response()->json(
            $result,
        );
    }   

    public function showCourseClassStudents(Request $request)
    {
        $class_code = $request->class_code;
        $students = [];
        $course_class = CourseClass::where('class_code', $class_code)->first();
        foreach ($course_class->students as $student) {
            $students[] = [
                'student_code' => $student->student_code,
                'student_name' => $student->name,
                'student_avatar' => $student->avatar == null || $student->avatar == '' ? asset('assets/images/default_avatar.jpg') : $student->avatar,
            ];
        }

        return response()->json([
            'students' => $students,
        ]);
    }

    public function showStudentDetails(Request $request)
    {
        $student_code = $request->student_code;
        $student = Student::where('student_code', $student_code)->first();
        $class = $student->class;
        $system = EducationalSystem::find($class->system_id);
        $unit = $class->unit;

        $data = [
            'student_code' => $student->student_code,
            'name' => $student->name,
            'address' => $student->address,
            'email' => $student->email,
            'avatar' => $student->avatar == null || $student->avatar == '' ? asset('assets/images/default_avatar.jpg') : $student->avatar,
            'class_name' => $class->name,
            'system' => $system->name,
            'unit' => $unit->name
        ];

        return response()->json([
            'student' => $data,
        ]);
    }

    public function showTeacherDetails(Request $request)
    {
        $teacher_code = $request->teacher_code;
        $teacher = Teacher::where('teacher_code', $teacher_code)->first();

        $data = [
            'teacher_code' => $teacher->teacher_code,
            'name' => $teacher->name,
            'email' => $teacher->email,
            'unit' => $teacher->unit->name,
            'avatar' => $teacher->avatar == null || $teacher->avatar == '' ? asset('assets/images/default_avatar.jpg') : $teacher->avatar,
        ];

        return response()->json([
            'teacher' => $data,
        ]);
    }
}

<?php

namespace App\Http\Controllers\Search;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Teacher;
use App\Models\Student;
use App\Models\Course;
use App\Models\CourseClass;
use App\Models\Semester;

class SearchController extends Controller
{
    function searchTeacher(Request $request)
    {

        $teachers = Teacher::where('name', 'like', '%' . $request->input . '%')->get();
        $result = [];

        foreach ($teachers as $teacher) {
            $result[] = [
                'teacher_code' => $teacher->teacher_code,
                'name' => $teacher->name,
                'avatar' => $teacher->avatar == null || $teacher->avatar == '' ? asset('assets/images/default_avatar.jpg') : $teacher->avatar,
            ];
        }

        if (!$result) {
            return response()->json([
                'message' => 'Không tìm thấy kết quả phù hợp',
            ],404);
        }

        return response()->json([
            'teachers' => $result,
        ]);
    }

    function searchStudent(Request $request)
    {
        $students = Student::where('name', 'like', '%' . $request->input . '%')
            ->orWhere('student_code', $request->input)->take(10)->get();
        $result = [];
        foreach ($students as $student) {
            $result[] = [
                'student_code' => $student->student_code,
                'name' => $student->name,
                'avatar' => $student->avatar == null || $student->avatar == '' ? asset('assets/images/default_avatar.jpg') : $student->avatar,
            ];
        }

        if (!$result) {
            return response()->json([
                'message' => 'Không tìm thấy kết quả phù hợp',
            ],404);
        }

        return response()->json([
            'students' => $result,
        ]);
    }

    function searchCourse(Request $request)
    {
        $currentDate = date('Y-m-d');
        $currentSemester = Semester::where('start_date', '<=', $currentDate)
            ->where('end_date', '>=', $currentDate)
            ->get();
        $courses = Course::where('course_code', $request->input)->get();
        $result = [];
        $systems = [];
        foreach ($courses as $course) {
            foreach ($course->systems as $system) {
                $systems[] = $system->system;
            }
            $classes = $course->course_classes->where('semester_id',$currentSemester[0]->id);
            
            $result[] = [
                'course_code' => $course->course_code,
                'name' => $course->name,
                'type' => $course->type,
                'number_of_credit' => $course->number_of_credit,
                'classes' => $classes,
                'systems' => $systems,
            ];
        }

        if (!$result) {
            return response()->json([
                'message' => 'Không tìm thấy kết quả phù hợp',
            ],404);
        }

        return response()->json([
            'course' => $result,
        ]);
    }

    function searchCourseClass(Request $request)
    {
        $currentDate = date('Y-m-d');
        $currentSemester = Semester::where('start_date', '<=', $currentDate)
            ->where('end_date', '>=', $currentDate)
            ->get();
        $course_class = CourseClass::where('class_code', $request->input)
            ->where('semester_id', $currentSemester[0]->id)->get();
        if ($course_class->isEmpty()) {
            return response()->json([
                'message' => 'Không tìm thấy kết quả phù hợp',
            ],404);
        }
        $systems = [];
        foreach ($course_class[0]->course->systems as $system) {
            $systems[] = $system->system;
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
            'description' => $course_class[0]->description,
        ];

        if (!$result) {
            return response()->json([
                'message' => 'Không tìm thấy kết quả phù hợp',
            ],404);
        }

        return response()->json(
            $result,
        );
    }
}

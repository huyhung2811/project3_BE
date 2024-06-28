<?php

use App\Http\Controllers\Attendance\AttendanceController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Search\SearchController;
use App\Http\Controllers\Student\ProfileController as StudentProfileController;
use App\Http\Controllers\Teacher\ProfileController as TeacherProfileController;
use App\Http\Controllers\Admin\ProfileController as AdminProfileController;
use App\Http\Controllers\Admin\UserManager;
use App\Http\Controllers\Student\StudentController;
use App\Http\Controllers\Teacher\TeacherController;
use App\Http\Controllers\Common\CommonController;
use App\Http\Controllers\DayOff\DayOffController;
use App\Http\Controllers\Device\DeviceController;
use App\Http\Controllers\Admin\UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout']);

Route::controller(CommonController::class)->middleware('auth:api')->group(function(){
    Route::post('/class-students','showClassStudents')->name('class.students.show');
    Route::post('/course-class-details', 'showCourseClassDetails')->name('course.class.details.show');
    Route::post('/course-class-students','showCourseClassStudents')->name('course-class.student.show');
    Route::post('/student-details','showStudentDetails')->name('student.details.show');
    Route::post('/teacher-details','showTeacherDetails')->name('teacher.details.show');
});

Route::prefix('admin')->middleware('auth:api')->group(function(){
    Route::controller(AdminProfileController::class)->prefix('profile')->group(function () {
        Route::get('/', 'profile')->name('admin.profile.show');
    });
});

Route::prefix('student')->middleware(['auth:api','checkrole:student'])->group(function () {
    Route::controller(StudentProfileController::class)->prefix('profile')->group(function () {
        Route::get('/', 'profile')->name('student.profile.show');
        Route::put('/', 'update')->name('student.profile.update');
    });
    Route::controller(StudentController::class)->group(function(){
        Route::get('/course-class', 'showCourseClass')->name('student.course_class.show');
        Route::get('/class', 'showStudentClass')->name('student.student_class.show');
        Route::get('/schedule-in-day', 'showScheduleInDay')->name('student.schedule_in_day.show');
        Route::get('/schedule-in-week', 'showScheduleInWeek')->name('student.schedule_in_week.show');
        Route::get('/schedule-in-month', 'showScheduleInMonth')->name('student.schedule_in_month.show');
        Route::post('/create-day-attendance', 'createDayAttendance')->name('student.attendance.create_day_attendance');
        Route::put('/attendance', 'storeAttendance')->name('student.attendance.store');
        Route::post('/attendance', 'showAttendance')->name('student.attendance.show');
        Route::post('/attendance-by-day', 'showAttendanceByDay')->name('student.attendance.show_by_day');
    });
});

Route::prefix('teacher')->middleware(['auth:api','checkrole:teacher'])->group(function () {
    Route::controller(TeacherProfileController::class)->prefix('profile')->group(function () {
        Route::get('/', 'profile')->name('teacher.profile.show');
        Route::post('/update', 'update')->name('teacher.profile.update');   
    });
    Route::controller(TeacherController::class)->group(function () {
        Route::get('/schedule', 'showSchedule')->name('teacher.schedule.show');
        Route::get('/schedule-in-month', 'showScheduleInMonth')->name('teacher.schedule_in_month.show');
        Route::get('/schedule-in-day', 'showScheduleInDay')->name('teacher.schedule_in_day.show');
        Route::get('/course-class', 'showCourseClass')->name('teacher.course_class.show'); 
    });
});

Route::prefix('search')->middleware('auth:api')->controller(SearchController::class)->group(function(){
    Route::post('/teacher','searchTeacher')->name('search.teacher');
    Route::post('/student','searchStudent')->name('search.student');
    Route::post('/course','searchCourse')->name('search.course');
    Route::post('/course-class','searchCourseClass')->name('search.course_class');
});

Route::controller(AttendanceController::class)->prefix('attendance')->middleware('auth:api')->group(function(){
    Route::post('/','showClassAttendance')->name('class.attendance.show');
    Route::post('/update','updateStudentAttendance')->name('student.update.attendance');
});

Route::controller(DayOffController::class)->prefix('day-off')->middleware('auth:api')->group(function(){
    Route::get('/show', 'showDayOffRequest')->name('dayoff.show');
    Route::post('/create','storeDayOffRequest')->name('dayoff.store');
    Route::post('/change-is-read','changeIsReadRequest')->name('dayoff.is_read.change');
    Route::get('/request-details','showRequestDetails')->name('dayoff.details.show');
    Route::post('/change-request-status', 'updateRequestStatus')->name('dayoff.request_status.update');
});

Route::controller(DeviceController::class)->prefix('device')->group(function(){
    Route::post('/check','checkDeviceStatus')->name('device.check');
    Route::get('/show', 'showDevices')->middleware('auth:api')->name('devices.show');
    Route::post('/update', 'updateDevice')->middleware('auth:api')->name('device.update');
    Route::post('/delete', 'deleteDevice')->middleware('auth:api')->name('device.delete');
});

Route::controller(UserController::class)->prefix('user')->middleware('auth:api')->group(function(){
    Route::get('/','getUserList')->name('users.list');
    Route::post('/update', 'updateUser')->name('user.update');
    Route::post('/delete', 'deleteUser')->name('user.delete');
});



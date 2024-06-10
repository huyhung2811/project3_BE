<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentsClasses extends Model
{
    use HasFactory;
    protected $table = 'students_classes';
    public $timestamps = false;

    public function student_attendances()
    {
        return $this->hasMany(StudentAttendance::class,'student_class_id','id');
    }
    
    public function day_off_requests()
    {
        return $this->hasMany(DayOffRequest::class,'student_class_id','id');
    } 

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_code', 'student_code');
    }

    public function courseClass()
    {
        return $this->belongsTo(CourseClass::class, 'class_code', 'class_code');
    }
}

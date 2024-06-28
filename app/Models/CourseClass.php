<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseClass extends Model
{
    use HasFactory;
    protected $table = 'course_classes';
    public $timestamps = false;
    protected $primaryKey = 'class_code';
    public $incrementing = false;

    public function course()
    {
        return $this->belongsTo(Course::class,'course_code','course_code');
    }

    public function semester()
    {
        return $this->belongsTo(Semester::class,'semester_id');
    }

    public function room()
    {
        return $this->belongsTo(Room::class,'room_id');
    }

    public function students()
    {
        return $this->belongsToMany(Student::class, 'students_classes', 'class_code', 'student_code');
    }

    public function teacher()
    {
        return $this->belongsTo(Teacher::class,'teacher_code', 'teacher_code');
    }
}

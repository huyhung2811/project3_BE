<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentAttendance extends Model
{
    use HasFactory;
    protected $table = 'student_attendances';
    protected $fillable = ['student_class_id', 'day', 'status'];
    public $timestamps = false;

    public function students_classes()
    {
        return $this->belongsTo(StudentsClasses::class,'student_class_id','id');
    }

    public function attendance_times()
    {
        return $this->hasMany(AttendanceTime::class,'student_attendance_id','id');
    }   
}

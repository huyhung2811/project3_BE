<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttendanceTime extends Model
{
    use HasFactory;
    protected $table = 'attendance_times';
    public $timestamps = false;

    public function students_attendances()
    {
        return $this->belongsTo(StudentAttendance::class,'student_attendance_id','id');
    }
}

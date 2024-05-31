<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;
    protected $table = 'courses';
    public $timestamps = false;

    public function systems()
    {
        return $this->hasMany(SystemsCourses::class, 'course_code', 'course_code');
    }

    public function course_classes()
    {
        return $this->hasMany(CourseClass::class,'course_code','course_code');
    }
    public function unit()
    {
        return $this->belongsTo(Unit::class, 'unit_id', 'id');
    }
}

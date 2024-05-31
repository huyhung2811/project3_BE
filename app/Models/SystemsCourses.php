<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SystemsCourses extends Model
{
    use HasFactory;
    protected $table = 'systems_courses';
    public $timestamps = false;

    public function system()
    {
        return $this->belongsTo(EducationalSystem::class, 'system_id');
    }

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_code', 'course_code');
    }
}

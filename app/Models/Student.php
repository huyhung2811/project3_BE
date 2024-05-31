<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    
    protected $table = 'students';
    public $timestamps = false;
    protected $primaryKey = 'student_code';
    public $incrementing = false;

    protected $fillable = [
        'phone',
        'address',
        'home_town',
        'avatar',
    ];

    public function course_classes()
    {
        return $this->belongsToMany(CourseClass::class, 'students_classes', 'student_code', 'class_code');
    }

    public function class()
    {
        return $this->belongsTo(StudentClass::class,'class_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class,'email','email');
    }
}
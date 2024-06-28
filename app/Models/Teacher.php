<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;
    protected $table = 'teachers';
    public $timestamps = false;

    public function unit()
    {
        return $this->belongsTo(Unit::class,'unit_id','id');
    }

    public function course_classes(){
        return $this->hasMany(CourseClass::class,'teacher_code','teacher_code');
    }

    public function user()
    {
        return $this->belongsTo(User::class,'email','email');
    }

    public function getAvatarAttribute($value)
    {
        return $value ? $value : asset("assets/images/default_avatar.jpg");
    }
}

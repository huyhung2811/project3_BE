<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $table = 'rooms';
    public $timestamps = false;

    public function course_classes()
    {
        return $this->hasMany(CourseClass::class, 'room_id');
    }

    public function devices()
    {
        return $this->hasMany(Device::class, 'room_id');
    }
}

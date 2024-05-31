<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EducationalSystem extends Model
{
    use HasFactory;

    protected $table = 'educational_systems';
    public $timestamps = false;

    public function classes()
    {
        return $this->hasMany(StudentClass::class, 'id', 'system_id');
    }

    public function courses()
    {
        return $this->hasMany(SystemsCourses::class, 'system_id');
    }
}

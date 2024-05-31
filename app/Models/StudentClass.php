<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentClass extends Model
{
    use HasFactory;
    protected $table = 'classes';
    public $timestamps = false;

    public function system()
    {
        return $this->belongsTo(EducationalSystem::class);
    }

    public function students()
    {
        return $this->hasMany(Student::class, 'class_id');
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class, 'unit_id', 'id');
    }
}

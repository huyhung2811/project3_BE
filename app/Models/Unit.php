<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    use HasFactory;
    protected $table = 'units';
    public $timestamps = false;

    public function teachers()
    {
        return $this->hasMany(Teacher::class,'id','unit_id');
    }

    public function classes()
    {
        return $this->hasMany(StudentClass::class,'id','unit_id');
    }
    public function courses()
    {
        return $this->hasMany(Course::class,'id','unit_id');
    }
}

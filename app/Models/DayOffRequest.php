<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DayOffRequest extends Model
{
    use HasFactory;

    protected $table = 'day_off_requests';
    public $timestamps = false;

    protected $fillable = [
        'student_class_id',
        'day',
        'created_day',
        'created_time',
        'updated_time',
        'reason',
        'status',
        'is_read',
    ];

    public function students_classes()
    {
        return $this->belongsTo(StudentsClasses::class,'student_class_id','id');
    }
}

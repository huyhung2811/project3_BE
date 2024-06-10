<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Holiday extends Model
{
    use HasFactory;

    protected $table = 'holidays';
    public $timestamps = false;

    protected $fillable = [
        'description',
        'start_date',
        'end_date',
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Device extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'devices';
    public $timestamps = false;

    protected $fillable = [
        'room_id',
        'MAC_address',
        'updated_time'
    ];

    public function room()
    {
        return $this->belongsTo(Room::class,'room_id');
    }
}

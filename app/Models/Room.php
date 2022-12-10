<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $table = "rooms";
    protected $fillable = ['room_type_id'];
    public $with = ['type'];

    public function type()
    {
        return $this->belongsTo(RoomType::class, 'room_type_id', 'id');
    }
    
    public function bookings()
    {
        return $this->hasMany(Booking::class, 'room_id', 'id');
    }
}

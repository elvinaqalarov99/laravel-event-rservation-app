<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = ['event_id', 'user_name', 'seat_number'];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}

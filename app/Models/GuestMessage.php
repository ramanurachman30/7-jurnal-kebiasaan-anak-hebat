<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GuestMessage extends Model
{
    use HasFactory;

    protected $fillable = [
        'event_id',
        'guest_name',
        'message',
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
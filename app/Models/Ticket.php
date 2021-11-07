<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;
    protected $table = "event_tickets";
    protected $fillable = [
        'event_id',
        'ticket_number',
        'price',
    ];
}

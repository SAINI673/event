<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
  

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $table = "events";
    protected $fillable = [
        'event_name',
        'event_description',
        'event_start_date',
        'event_end_date',
        'event_organizer'
    ];

   
    
}

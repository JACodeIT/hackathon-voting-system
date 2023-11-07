<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event_Squads extends Model
{
    use HasFactory;

    protected $table = 'event_squads';

    protected $fillable = [
        'event_id',
        'squad_id'
    ];
}

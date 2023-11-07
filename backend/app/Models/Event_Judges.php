<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event_Judges extends Model
{
    use HasFactory;

    protected $table = 'event_judges';

    protected $fillable = [
        'event_id',
        'member_id',
    ];
}

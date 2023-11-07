<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event_Criteria extends Model
{
    use HasFactory;

    protected $table = 'event_criterias';

    protected $fillable = [
        'event_id',
        'criteria_id',
    ];
}

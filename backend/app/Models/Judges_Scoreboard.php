<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Judges_Scoreboard extends Model
{
    use HasFactory;

    protected $table = 'judges_scoreboards';

    protected $fillable = [
        'event_judge',
        'event_criteria',
        'criterion',
        'squad_id',
        'score',
    ];
}

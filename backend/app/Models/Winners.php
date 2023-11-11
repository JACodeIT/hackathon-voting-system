<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Winners extends Model
{
    use HasFactory;

    protected $table = 'winners';

    protected $fillable = [
        'event_id',
        'squad_id',
        'rank',
        'rating',
        'awards'
    ];
}

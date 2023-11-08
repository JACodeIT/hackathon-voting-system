<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PublicVotes extends Model
{
    use HasFactory;

    protected $table = 'public_votes';

    protected $fillable = [
        'event_id',
        'squad_id',
        'email',
    ];
}

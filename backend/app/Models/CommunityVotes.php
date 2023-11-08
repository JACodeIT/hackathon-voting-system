<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommunityVotes extends Model
{
    use HasFactory;

    protected $table = 'community_votes';

    protected $fillable = [
        'event_id',
        'squad_id',
        'member_id',
    ];
}

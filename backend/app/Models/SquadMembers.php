<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SquadMembers extends Model
{
    use HasFactory;

    protected $table = 'squad_members';

    protected $fillable = [
        'squad_id',
        'member_id',
    ];
}

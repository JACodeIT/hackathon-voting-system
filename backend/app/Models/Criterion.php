<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Criterion extends Model
{
    use HasFactory;

    protected $table = 'criterions';

    protected $fillable = [
        'criterion',
        'description',
        'guidelines'
    ];

    protected $casts = [
        'guidelines' => 'array'
    ];
}

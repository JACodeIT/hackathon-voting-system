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

    /**
     * Get the user associated with the Judges_Scoreboard
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function judge()
    {
        return $this->hasOne(Member::class, 'id', 'event_judge');
    }

    /**
     * Get all of the criteria for the Judges_Scoreboard
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function criteria()
    {
        return $this->hasMany(Criteria::class, 'id', 'event_criteria');
    }


}

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


    /**
     * Get all of the criteria for the Event_Criteria
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function criteria()
    {
        return $this->hasMany(Criteria::class, 'id', 'criteria_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Events extends Model
{
    use HasFactory;

    protected $table = 'events';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'organizer_id',
        'topic',
        'start_date',
        'end_date',
        'announcement_date',
        'description',
        'status',
        'venue',
        'address_line_1',
        'address_line_2',
        'brgy_address',
        'complete_address',
        'banner_url',
        'isGroup',
        'number_of_members',
        'member_can_vote',
        'public_can_vote',
        'member_numbers_of_vote',
        'public_numbers_of_vote',
        'judge_vote_percentage',
        'member_vote_percentage',
        'public_vote_percentage',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'announcement_date' => 'datetime',
    ];

    /**
     * Get the user associated with the Events
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function organizer()
    {
        return $this->hasOne(Member::class, 'id', 'organizer_id')->select('id', 'first_name', 'middle_name', 'last_name');
    }

    /**
     * Get all of the comments for the Events
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function judges()
    {
        return $this->belongsToMany(Member::class, 'event_judges', 'event_id', 'member_id');
    }

    /**
     * Get all of the comments for the Events
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function criteria()
    {
        return $this->belongsToMany(Criteria::class, 'event_criterias', 'event_id', 'criteria_id');
    }

    public function squads()
    {
        return $this->belongsToMany(Squads::class, 'event_squads', 'event_id', 'squad_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Squads extends Model
{
    use HasFactory;

    protected $table = 'squads';

    protected $fillable =[
        'leader_id',
        'name',
    ];

    public function leader(){
        return $this->hasOne(Member::class, 'id', 'leader_id')->select('id','first_name','middle_name','last_name','name_extension');
    }

    /**
     * Get all of the members for the Squads
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function members()
    {
        return $this->belongsToMany(Member::class, 'squad_members', 'squad_id', 'member_id');
    }

    /**
     * The events that belong to the Squads
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function events()
    {
        return $this->belongsToMany(Events::class, 'event_squads', 'squad_id', 'event_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    protected $table = "members";

    protected $fillable = [
        'user_id',
        'first_name',
        'middle_name',
        'last_name',
        'name_extension',
        'github_account',
        'discord_username',
        'be_rating',
        'fe_rating',
        'ui_ux_rating'
    ];

    /**
     * The squads that belong to the Member
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function squads()
    {
        return $this->belongsToMany(Squads::class, 'squad_members', 'member_id', 'id');
    }

    /**
     * Get the user associated with the Member
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function account()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}

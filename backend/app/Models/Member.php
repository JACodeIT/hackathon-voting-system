<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    protected $table = "members";

    protected $fillable = [
        'first_name',
        'middle_name',
        'last_name',
        'name_extension',
        'github_account',
        'discord_username',
    ];

    /**
     * The squads that belong to the Member
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function squads(): BelongsToMany
    {
        return $this->belongsToMany(Squads::class, 'squad_members', 'member_id', 'squad_id');
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

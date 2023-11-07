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

    // /**
    //  * Get all of the members for the Squads
    //  *
    //  * @return \Illuminate\Database\Eloquent\Relations\HasMany
    //  */
    // public function members(): HasMany
    // {
    //     return $this->hasMany(Members::class, 'foreign_key', 'local_key');
    // }
}

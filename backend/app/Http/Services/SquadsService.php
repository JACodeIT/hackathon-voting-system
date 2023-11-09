<?php

namespace App\Http\Services;

use DB;

use App\Models\Squads;

class SquadsService
{
    public function getSquadName(Int $squad_id){
        return Squads::find($squad_id)->name;
    }

    public function getSquadLeaderName(Int $squad_id){
        return Squads::find($squad_id)->leader->first_name. ' ' .Squads::find($squad_id)->leader->last_name;
    }

}

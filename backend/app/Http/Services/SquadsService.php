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

    public function getEventSquads(Int $event_id)
    {
        return DB::table('event_squads')
                        ->join('squads', 'event_squads.squad_id', '=', 'squads.id')
                        ->where('event_squads.event_id', $event_id)
                        ->select('squads.id as squad_id', 'squads.name as squad_name')
                        ->get();
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\PublicVotes;
use App\Models\Squads;
use App\Models\Events;
use App\Models\Event_Judges;
use App\Models\SquadMembers;
use Illuminate\Http\Request;
use DB;
class PublicVotesController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $voteData = [
            'event_id' => $request->event_id,
            'squad_id' => $request->squad_id,
            'email' => $request->email
        ];
        $verifier = [];
        $event = Events::find($request->event_id);
        $maxVotesPerPublic = $event->public_numbers_of_vote;
        $publicHasVoted = PublicVotes::where('event_id', $request->event_id)->where('email', $request->email)->get();

        for($i=0;$i < count($publicHasVoted);$i++){
            $holder = [
                'event_id' => $publicHasVoted[$i]->event_id,
                'squad_id' => $publicHasVoted[$i]->squad_id,
                'email' => $publicHasVoted[$i]->email
            ];
            array_push($verifier,$holder);
        }

        // Member can vote flag
        if(!$event->public_can_vote){
            return response()->json([
                'message'   => 'Event does not allow voting from the public.',
                ],400);
        }

        // Max votes per member
        if(count($publicHasVoted) >= $maxVotesPerPublic){
            return response()->json([
                'message'   => $maxVotesPerPublic === 1 ? 'You have already voted.' : 'You have already voted '.$maxVotesPerPublic.' times.',
                ],400);
        }

        // Member cannot vote on the same squad
        if(in_array($voteData,$verifier)){
            return response()->json([
                'message'   => 'You cannot vote on the same entry twice.',
                ],400);
        }


        $publicVote = PublicVotes::create($voteData);

        return response()->json([
            'message' => 'You have voted for '.Squads::find($request->squad_id)->name,
            'data'  => $publicVote
        ],201);
    }

    public function getEventSquadPublicVotes(Int $squad_id, Int $event_id){
        $totalVoters = $this->getTotalPublicVoters($event_id);
        $communityVotes = $this->getPublicVotes($event_id,$squad_id);

        if($totalVoters->total == 0){
            return response()->json([
                'message' => 'No recorded community votes.',
                'data'  => [
                    'totalVoters' => $totalVoters->total,
                    'communityVotes' => $communityVotes->votesReceived,
                    'percentage' => 0
                ]
            ],400);
        }
        return response()->json([
            'message' => 'Community Votes for '.Squads::find($squad_id)->name,
            'data'  => [
                'totalVoters' => $totalVoters->total,
                'communityVotes' => $communityVotes->votesReceived,
                'percentage' => ($communityVotes->votesReceived / $totalVoters->total) * Events::find($event_id)->public_vote_percentage
            ]
        ],200);
    }

    private function getTotalPublicVoters(Int $event_id)
    {
        return DB::table('public_votes')
                    ->select(DB::raw('COUNT(DISTINCT email) as total'))
                    ->where('event_id', $event_id)
                    ->first();
    }

    private function getPublicVotes(Int $event_id, Int $squad_id)
    {
        return DB::table('public_votes')
                    ->select(DB::raw('COUNT(DISTINCT email) as votesReceived'))
                    ->where('event_id', $event_id)
                    ->where('squad_id', $squad_id)
                    ->first();
    }
}

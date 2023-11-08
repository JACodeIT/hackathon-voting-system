<?php

namespace App\Http\Controllers;

use App\Models\CommunityVotes;
use App\Models\Squads;
use App\Models\Events;
use App\Models\Event_Judges;
use App\Models\SquadMembers;
use Illuminate\Http\Request;

use DB;

class CommunityVotesController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $voteData = [
            'event_id' => $request->event_id,
            'squad_id' => $request->squad_id,
            'member_id' => $request->member_id
        ];
        $verifier = [];

        $event = Events::find($request->event_id);
        $maxVotesPerMember = $event->member_numbers_of_vote;
        $memberHasVoted = CommunityVotes::where('event_id', $request->event_id)->where('member_id', $request->member_id)->get();
        $squadMember = SquadMembers::where('squad_id', $request->squad_id)->where('member_id', $request->member_id)->get();
        $squadLeader = Squads::where('id', $request->squad_id)->where('leader_id', $request->member_id)->get();
        $eventJudge = Event_Judges::where('event_id', $request->event_id)->where('member_id', $request->member_id)->get();

        for($i=0;$i < count($memberHasVoted);$i++){
            $holder = [
                'event_id' => $memberHasVoted[$i]->event_id,
                'squad_id' => $memberHasVoted[$i]->squad_id,
                'member_id' => $memberHasVoted[$i]->member_id
            ];
            array_push($verifier,$holder);
        }

        // Check if Voter is a judge
        if(count($eventJudge) > 0){
            return response()->json([
                'message'   => 'Voter is already a member of Judges for this event.',
                ],400);
        }

        // Check if Voter is a part or leader of the squad
        if(count($squadMember) > 0 || count($squadLeader) > 0){
            return response()->json([
                'message'   => 'You can not vote for your own squad. :3',
                ],400);
        }

        // Member can vote flag
        if(!$event->member_can_vote){
            return response()->json([
                'message'   => 'Event does not allow voting from community members.',
                ],400);
        }

        // Max votes per member
        if(count($memberHasVoted) >= $maxVotesPerMember){
            return response()->json([
                'message'   => $maxVotesPerMember === 1 ? 'Member has already voted' : 'Member has already voted '.$maxVotesPerMember.' times',
                ],400);
        }


        // Member cannot vote on the same squad
        if(in_array($voteData,$verifier)){
            return response()->json([
                'message'   => 'Member cannot vote on the same squad.',
                ],400);
        }

        $communityVote = CommunityVotes::create($voteData);

        return response()->json([
            'message' => 'You have voted for '.Squads::find($request->squad_id)->name,
            'data'  => $communityVote
        ],201);
    }

    public function getEventSquadCommunityVotes(Int $squad_id, Int $event_id){
        $totalVoters = $this->getTotalVoters($event_id);
        $communityVotes = $this->getCommunityVotes($event_id,$squad_id);

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
                'percentage' => ($communityVotes->votesReceived / $totalVoters->total) * Events::find($event_id)->member_vote_percentage
            ]
        ],200);
    }

    private function getTotalVoters(Int $event_id)
    {
        return DB::table('community_votes')
                    ->select(DB::raw('COUNT(DISTINCT member_id) as total'))
                    ->where('event_id', $event_id)
                    ->first();
    }

    private function getCommunityVotes(Int $event_id, Int $squad_id)
    {
        return DB::table('community_votes')
                    ->select(DB::raw('COUNT(DISTINCT member_id) as votesReceived'))
                    ->where('event_id', $event_id)
                    ->where('squad_id', $squad_id)
                    ->first();
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Events;
use App\Models\Event_Criteria;
use App\Models\Event_Judges;
use App\Models\Event_Squads;
use App\Models\Member;
use App\Models\Criteria;
use App\Models\Criterion;
use App\Models\Squads;
use App\Models\Judges_Scoreboard;
use App\Models\Winners;
use App\Http\Requests\StoreEventsRequest;
use App\Http\Requests\UpdateEventsRequest;
use App\Http\Resources\EventsCollection;
use Illuminate\Http\Request;
use DB;


use App\Http\Services\EventsService;
use App\Http\Services\SquadsService;

class EventsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return new EventsCollection(count($request->all()) > 0 ?
                Events::with('organizer.account', 'judges.account', 'criteria.criterion','squads')->where('status', $request->status)->get() :
                Events::with('organizer.account', 'judges.account', 'criteria.criterion','squads')->get());
}

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEventsRequest $request)
    {
        $events = Events::create([
            'organizer_id'              => $request->organizer_id,
            'topic'                     => $request->topic,
            'description'               => $request->description,
            'start_date'                => $request->start_date,
            'end_date'                  => $request->end_date,
            'announcement_date'         => $request->announcement_date,
            'status'                    => $request->status,
            'address_line_1'            => $request->address_line_1,
            'address_line_2'            => $request->address_line_2,
            'brgy_address'              => $request->brgy_address,
            'complete_address'          => $request->complete_address,
            'banner_url'                => $request->banner_url,
            'isGroup'                   => $request->isGroup,
            'venue'                     => $request->venue,
            'number_of_members'         => $request->number_of_members,
            'member_can_vote'           => $request->member_can_vote,
            'public_can_vote'           => $request->public_can_vote,
            'member_numbers_of_vote'    => $request->member_numbers_of_vote,
            'public_numbers_of_vote'    => $request->public_numbers_of_vote,
            'judge_vote_percentage'     => $request->judge_vote_percentage,
            'member_vote_percentage'    => $request->member_vote_percentage,
            'public_vote_percentage'    => $request->public_vote_percentage,
            'maximum_registrants'       => $request->maximum_registrants
        ]);

        return response()->json([
            'message'   => Events::find($events->id)->topic.' was created.',
            'data'      => new EventsCollection(Events::with('organizer', 'judges.account', 'criteria.criterion')
                                ->where('id', $events->id)
                                ->get())
        ],201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Int $id, SquadsService $squadService)
    {
        if(is_null(Events::find($id))){
            return response()->json([
                'error' => true,
                'message' => 'Event does not exist.'
            ]);
        }

        return response()->json([
            'success'   => true,
            'data'      => [
                'events' => Events::with('organizer', 'judges.account', 'criteria.criterion','squads.leader')
                                ->where('id', $id)
                                ->get(),
                'number_of_squads' => Event_Squads::where('event_id', $id)->count(),
            ],
        ],200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEventsRequest $request, Int $id)
    {
        $input = $request->all();
        unset($input['_method']);

        Events::where('id', $id)->update($input);

        return response()->json([
            'message'   => Events::find($id)->topic.' details was updated.',
            'data'      => new EventsCollection(Events::with('organizer', 'judges.account', 'criteria.criterion')
                                ->where('id', $id)
                                ->get())
        ],200);
    }

    public function addCriteriaToEvent(Int $event_id, Request $request)
    {
        $eventCriteria = Event_Criteria::firstOrCreate([
            'event_id' => $event_id,
            'criteria_id' => $request->criteria_id
        ]);

        if(!$eventCriteria->wasRecentlyCreated){
            return response()->json([
                'message'   => Criterion::find(Criteria::find($request->criteria_id)->criterion_id)->criterion. ' is alreay a criterion of '. Events::find($event_id)->topic.'.',
                'data'      => Events::with('organizer', 'judges.account', 'criteria.criterion')
                                ->where('id', $event_id)
                                ->get()
            ],400);
        }

        return response()->json([
            'message'   => Criterion::find(Criteria::find($request->criteria_id)->criterion_id)->criterion. ' has been added to '. Events::find($event_id)->topic.'.',
            'data'      => Events::with('organizer', 'judges.account', 'criteria.criterion')
                                    ->where('id', $event_id)
                                    ->get()
        ],200);
    }

    public function removeCriteriaToEvent(Int $event_id, Int $criteria_id, Request $request)
    {
        $eventCriteria = Event_Criteria::where('event_id', $event_id)
                        ->where('criteria_id', $criteria_id)
                        ->first();

        if(!empty($eventCriteria)){
            $eventCriteria->delete();

            return response()->json([
                'message'   => Criterion::find(Criteria::find($criteria_id)->criterion_id)->criterion. ' was removed from '. Events::find($event_id)->topic.'.',
                'data'      => Events::with('organizer', 'judges.account', 'criteria.criterion')
                                ->where('id', $event_id)
                                ->get()
                ],200);
        }

        return response()->json([
            'message'   => Criterion::find(Criteria::find($criteria_id)->criterion_id)->criterion. ' is not currently linked to '. Events::find($event_id)->topic.'.',
            'data'      => Events::with('organizer', 'judges.account', 'criteria.criterion')
                                    ->where('id', $event_id)
                                    ->get()
        ],200);
    }


    public function addJudgeToEvent(Int $event_id, Request $request)
    {
        $eventJudge = Event_Judges::firstOrCreate([
            'event_id' => $event_id,
            'member_id' => $request->member_id
        ]);

        if(!$eventJudge->wasRecentlyCreated){
            return response()->json([
                'message'   => Member::find($request->member_id)->first_name. ' ' .Member::find($request->member_id)->last_name .' is alreay a judge for '. Events::find($event_id)->topic.'.',
                'data'      => Events::with('organizer', 'judges.account', 'criteria.criterion')
                                ->where('id', $event_id)
                                ->get()
            ],400);
        }

        return response()->json([
            'message'   => Member::find($request->member_id)->first_name. ' ' .Member::find($request->member_id)->last_name .' has been added as judge to '. Events::find($event_id)->topic.'.',
            'data'      => Events::with('organizer', 'judges.account', 'criteria.criterion')
                                    ->where('id', $event_id)
                                    ->get()
        ],200);
    }

    public function removeJudgeToEvent(Int $event_id, Int $judge_id, Request $request)
    {
        $eventJudge = Event_Judges::where('event_id', $event_id)
                        ->where('member_id', $judge_id)
                        ->first();

        if(!empty($eventJudge)){
            $eventJudge->delete();

            return response()->json([
                'message'   => Member::find($judge_id)->first_name. ' ' .Member::find($judge_id)->last_name .' was removed as a judge to '. Events::find($event_id)->topic.'.',
                'data'      => Events::with('organizer', 'judges.account', 'criteria.criterion')
                                ->where('id', $event_id)
                                ->get()
                ],200);
        }

        return response()->json([
            'message'   => Member::find($judge_id)->first_name. ' ' .Member::find($judge_id)->last_name .' is not judge of '. Events::find($event_id)->topic.'.',
            'data'      => Events::with('organizer', 'judges.account', 'criteria.criterion')
                                    ->where('id', $event_id)
                                    ->get()
        ],200);
    }

    public function recordEventJudgeSquadScores(Int $event_id, Int $judge_id, Int $squad_id,
                                                    Request $request,
                                                    EventsService $eventService)
    {
        if(count($request->all()) == 0){
            return response()->json([
                'error'         => true,
                'message'       => 'Request is empty.',
            ],400);
        }

        $insertedData = [];
        for($i = 0 ; $i < count($request->all()) ; $i++){
            $rating = $eventService->getMinAndMaxScoreRating($event_id, $request[$i]['event_criteria_id']);
            $hasAlreadyScored = Judges_Scoreboard::where('event_judge', $judge_id)->where('squad_id', $squad_id)->where('event_criteria', $request[$i]['event_criteria_id'])->get();

            if($request[$i]['rating'] < $rating->min_rating || $request[$i]['rating'] > $rating->max_rating){
                return response()->json([
                    'error'         => true,
                    'message'       => 'Judge score must be equal or greater than '.$rating->min_rating.' and less than or equal to '.$rating->max_rating,
                    'criterion'     => $rating->criterion,
                    'rating'        => $request[$i]['rating']
                ],400);
            }

            if(count($hasAlreadyScored) > 0){
                return response()->json([
                    'error'         => true,
                    'message'       => 'Judge has already scored this criteria for this squad.',
                    'criterion'     => $rating->criterion,
                ],400);
            }

            $judgesScoreboard = Judges_Scoreboard::create([
                'event_judge' => $judge_id,
                'squad_id' => $squad_id,
                'event_criteria' => $request[$i]['event_criteria_id'],
                'score' => $request[$i]['rating']
            ]);

            array_push($insertedData, $judgesScoreboard);
        }

        return response()->json([
            'message'   => 'Successfully recorded event judge squad scores.',
            'data'      => $insertedData
        ],201);
    }



    public function calculateJudgeScore(Int $event_id, Int $judge_id, Int $squad_id,
                                            Request $request,
                                            EventsService $eventService,
                                            SquadsService $squadService)
    {
        $percentage_value = $eventService->getJudgeRawScoreRatingBasedOnWeight($event_id, $judge_id, $squad_id);
        $getRawScore = $eventService->getRawScoreRating($event_id, $judge_id, $squad_id)->score;
        $getMaxScore = $eventService->getMaxScoreRating($event_id, $judge_id, $squad_id)->score;

        return response()->json([
            'message' => 'Results for '.$squadService->getSquadName($squad_id),
            'data'  => [
                'judge' => $eventService->getJudgeName($judge_id),
                'raw_score' => $getRawScore.'/'.$getMaxScore,
                'percentage_value' => $percentage_value[count($percentage_value)-1]['percentage_value'] .'%',
                'rating' => $eventService->getDataFromJudgesScoreboard($event_id, $judge_id, $squad_id, ['crio.criterion', 'js.score']),
            ],
        ]);
    }

    public function getTotalScoreFromJudges(Int $event_id, Int $squad_id,
                                            Request $request,
                                            SquadsService $squadService,
                                            EventsService $eventService)
    {
        if($eventService->checkIfAllJudgeHasAlreadyScored($event_id, $squad_id)){
            return response()->json([
                'message' => 'Results for '.$squadService->getSquadName($squad_id).' is not ready. Waiting for all judges to complete their votes.',
                'data'  => [
                    'squadName' => $squadService->getSquadName($squad_id),
                    'squadLeader' => $squadService->getSquadLeaderName($squad_id),
                    'judges' => $eventService->getJudgesListForEvent($event_id),
                ],
            ]);
        }

        return response()->json([
            'message' => 'Results for '.$squadService->getSquadName($squad_id),
            'data'  => [
                'squadName' => $squadService->getSquadName($squad_id),
                'squadLeader' => $squadService->getSquadLeaderName($squad_id),
                'percentageValue' => $eventService->getRawScoreRatingBasedOnWeight($event_id, $squad_id),
                'weightPercentageValue' => ($eventService->getRawScoreRatingBasedOnWeight($event_id, $squad_id) / 100 ) * Events::find($event_id)->judge_vote_percentage,
                'judges' => $eventService->getJudgesListForEvent($event_id),
            ],
        ]);
    }



    public function getFinalScoresFromJudgesAndCommunity(Int $event_id, Int $squad_id,
                                                            Request $request,
                                                            EventsService $eventService,
                                                            SquadsService $squadService)
    {
        $total = $eventService->applyJudgeScoreWeight($event_id, $squad_id) +
                    $eventService->getCommunityVotesPercentage($squad_id, $event_id) +
                    $eventService->getPublicVotesPercentage($squad_id, $event_id);

        if($eventService->checkIfAllJudgeHasAlreadyScored($event_id, $squad_id)){
            return response()->json([
                'message' => 'Results for '.$squadService->getSquadName($squad_id).' is not ready. Waiting for all judges to complete their votes.',
                'data'  => [
                    'squadName' => $squadService->getSquadName($squad_id),
                    'squadLeader' => $squadService->getSquadLeaderName($squad_id),
                    'judges' => $eventService->getJudgesListForEvent($event_id),
                ],
            ]);
        }
        return response()->json([
            'message' => 'Results for '.$squadService->getSquadName($squad_id),
            'data'  => [
                'squadName' => $squadService->getSquadName($squad_id),
                'squadLeader' => $squadService->getSquadLeaderName($squad_id),
                'judgeScore' => $eventService->applyJudgeScoreWeight($event_id, $squad_id).'%',
                'communityVotes' => $eventService->getCommunityVotesPercentage($squad_id, $event_id).'%',
                'publicVotes' => $eventService->getPublicVotesPercentage($squad_id, $event_id).'%',
                'total' => round($total,4),
                'judges' => $eventService->getJudgesListForEvent($event_id),
            ],
        ]);
    }

    public function getEventSquadPublicVotes(Int $squad_id, Int $event_id, EventsService $eventService){
        $totalVoters = $eventService->getTotalPublicVoters($event_id);
        $communityVotes = $eventService->getPublicVotes($event_id,$squad_id);

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

    public function getAllFinalScoresFromJudgesAndCommunity(Int $event_id,  Request $request, EventsService $eventService)
    {
        $eventSquads = DB::table('events')
                    ->join('event_squads','event_squads.event_id', '=', 'events.id')
                    ->join('squads','squads.id', '=', 'event_squads.squad_id')
                    ->join('members','members.id', '=', 'squads.leader_id')
                    ->select('squads.id as squad_id',DB::raw('CONCAT(members.first_name, " ", members.last_name) as leaderName'),'squads.name as squadName')
                    ->get();

        $returnValue = [];

        for($i=0 ; $i < count($eventSquads) ; $i++){
            $total = $eventService->applyJudgeScoreWeight($event_id, $eventSquads[$i]->squad_id) +
                     $eventService->getCommunityVotesPercentage($eventSquads[$i]->squad_id, $event_id) +
                     $eventService->getPublicVotesPercentage($eventSquads[$i]->squad_id, $event_id);
            $handler = [
                'squad_id'  => $eventSquads[$i]->squad_id,
                'squadName' => $eventSquads[$i]->squadName,
                'squadLeader' => $eventSquads[$i]->leaderName,
                'judgeScore' => $eventService->applyJudgeScoreWeight($event_id, $eventSquads[$i]->squad_id),
                'communityVotes' => $eventService->getCommunityVotesPercentage($eventSquads[$i]->squad_id, $event_id),
                'publicVotes' => $eventService->getPublicVotesPercentage($eventSquads[$i]->squad_id, $event_id),
                'total' => round($total,4)
            ];
            array_push($returnValue,$handler);
        }
        // return $returnValue[0]['total'];
        usort($returnValue, function($a, $b) {
            $result = 0;
            if ($a['total'] < $b['total']) {
                $result = 1;
            } else if ($a['total'] > $b['total']) {
                $result = -1;
            }
            return $result;
        });

        for($x=0; $x < count($returnValue); $x++){
            $returnValue[$x]['rank'] = $x+1;
        }

        Winners::updateOrCreate(['event_id' => $event_id],
            [
                'squad_id'  => $returnValue[0]['squad_id'],
                'rank'      => $returnValue[0]['rank'],
                'rating'    => $returnValue[0]['total']
            ]);

        return response()->json([
            'message' => 'Results for '. Events::find($event_id)->topic,
            'data'=>[
                'eventDetails' => [
                    'eventTopic' => Events::find($event_id)->topic,
                    'Judge Score Percentage' => Events::find($event_id)->judge_vote_percentage,
                    'Community Score Percentage' => Events::find($event_id)->member_vote_percentage,
                    'Public Score Percentage' => Events::find($event_id)->public_vote_percentage,
                ],
                'eventWinner' => [
                    'squadName' => $returnValue[0]['squadName'],
                    'squadLeader' => $returnValue[0]['squadLeader'],
                    'rank' => $returnValue[0]['rank'],
                    'total' => $returnValue[0]['total']
                ],
                'rating'  => $returnValue,
            ]
        ]);
    }

    public function getEventJudges(Int $event_id)
    {
        $judges = DB::table('event_judges')
                    ->join('events','events.id', '=', 'event_judges.event_id')
                    ->join('members','members.id', '=', 'event_judges.member_id')
                    ->join('users','users.id', '=', 'members.user_id')
                    ->select('event_judges.id as judge_id', 'events.topic as eventTopic','members.id as member_id','users.id as user_id',DB::raw('CONCAT(members.first_name, " ", members.last_name) as name'))
                    ->where('event_judges.event_id', $event_id)
                    ->get();
        return response()->json([
            'message' => 'Judges for '.Events::find($event_id)->topic,
            'data'  => $judges
        ],200);
    }

    public function getNumberOfJudges(Int $event_id, EventsService $eventService)
    {
        return $eventService->getNumberOfJudges($event_id);
    }

    public function getEventCriteria(Int $event_id, EventsService $eventService)
    {
        $criteria = Event_Criteria::with('criteria.criterion')->where('event_id', $event_id)->get();
        return response()->json([
            'message' => 'Criteria for '.Events::find($event_id)->topic,
            'data'  => $criteria
        ],200);
    }

    public function forceDeclareWinner(Int $event_id, Request $request, EventsService $eventService)
    {
        if($eventService->validateIfTieIsPresent($event_id))
        {
            return response()->json([
                'message' => 'No tie detected. Force declare winner will not proceed.'
            ],200);
        }


        $total = $eventService->applyJudgeScoreWeight($event_id, $request->squad_id) +
                 $eventService->getCommunityVotesPercentage($request->squad_id, $event_id) +
                 $eventService->getPublicVotesPercentage($request->squad_id, $event_id);


        $winner = Winners::updateOrCreate(['event_id' => $event_id],
            [
                'squad_id'  => $request->squad_id,
                'rank'      => 1,
                'rating'    => $total
            ]);

        $squadLeader = DB::table('squads')
                            ->join('members','members.id', '=', 'squads.leader_id')
                            ->select(DB::raw('CONCAT(members.first_name, " ", members.last_name) as squadLeader'))
                            ->where('squads.id', $request->squad_id)
                            ->first();
        return response()->json([
            'success'   => true,
            'confirmation-message' => 'Tie detected.',
            'message' => 'Winner for '.Events::find($event_id)->topic,
            'data'  => [
                'eventWinner' => [
                    'squadName' => Squads::find($request->squad_id)->name,
                    'squadLeader' => $squadLeader->squadLeader,
                    'rank' => 1,
                    'total' => $total
                ],
            ]
        ],200);
    }
}

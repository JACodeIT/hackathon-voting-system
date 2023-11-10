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
use App\Http\Requests\StoreEventsRequest;
use App\Http\Requests\UpdateEventsRequest;
use App\Http\Resources\EventsCollection;
use Illuminate\Http\Request;
use DB;

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
            'public_vote_percentage'    => $request->public_vote_percentage
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
            'data'      => Events::with('organizer', 'judges.account', 'criteria.criterion')
                                ->where('id', $id)
                                ->get(),
            'number_of_squads' => Event_Squads::where('event_id', $id)->count(),
            'squads'    => $squadService->getEventSquads($id),
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



    /**
     * Formula:
        *Individual Rating Per Judge = [∑(score/max_rating * weight)]
        *
        *(∑(Individual Rating Per Judge) / Number of judges) * judge_score_weight
     */


    public function recordEventJudgeSquadScores(Int $event_id, Int $judge_id, Int $squad_id, Request $request)
    {
        if(count($request->all()) == 0){
            return response()->json([
                'error'         => true,
                'message'       => 'Request is empty.',
            ],400);
        }

        $insertedData = [];
        for($i = 0 ; $i < count($request->all()) ; $i++){
            $rating = $this->getMinAndMaxScoreRating($event_id, $request[$i]['event_criteria_id']);
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

    private function getMinAndMaxScoreRating(Int $event_id, Int $event_criteria_id)
    {
        return DB::table('event_criterias')
                        ->join('criterias', 'event_criterias.criteria_id', '=', 'criterias.id')
                        ->join('criterions','criterions.id', '=', 'criterias.criterion_id')
                        ->where('event_criterias.event_id', $event_id)
                        ->where('event_criterias.criteria_id', $event_criteria_id)
                        ->first();
    }

    public function calculateJudgeScore(Int $event_id, Int $judge_id, Int $squad_id, Request $request)
    {
        $percentage_value = $this->getJudgeRawScoreRatingBasedOnWeight($event_id, $judge_id, $squad_id);
        $getRawScore = $this->getRawScoreRating($event_id, $judge_id, $squad_id)->score;
        $getMaxScore = $this->getMaxScoreRating($event_id, $judge_id, $squad_id)->score;

        return response()->json([
            'message' => 'Results for '.$this->getSquadName($squad_id),
            'data'  => [
                'judge' => $this->getJudgeName($judge_id),
                'raw_score' => $getRawScore.'/'.$getMaxScore,
                'percentage_value' => $percentage_value[count($percentage_value)-1]['percentage_value'] .'%',
                'rating' => $this->getDataFromJudgesScoreboard($event_id, $judge_id, $squad_id, ['crio.criterion', 'js.score']),
            ],
        ]);
    }

    public function getTotalScoreFromJudges(Int $event_id, Int $squad_id, Request $request)
    {
        if($this->checkIfAllJudgeHasAlreadyScored($event_id, $squad_id)){
            return response()->json([
                'message' => 'Results for '.$this->getSquadName($squad_id).' is not ready. Waiting for all judges to complete their votes.',
                'data'  => [
                    'squadName' => $this->getSquadName($squad_id),
                    'squadLeader' => $this->getSquadLeaderName($squad_id),
                    'judges' => $this->getJudgesListForEvent($event_id),
                ],
            ]);
        }

        return response()->json([
            'message' => 'Results for '.$this->getSquadName($squad_id),
            'data'  => [
                'squadName' => $this->getSquadName($squad_id),
                'squadLeader' => $this->getSquadLeaderName($squad_id),
                'percentageValue' => $this->getRawScoreRatingBasedOnWeight($event_id, $squad_id),
                'weightPercentageValue' => ($this->getRawScoreRatingBasedOnWeight($event_id, $squad_id) / 100 ) * Events::find($event_id)->judge_vote_percentage,
                'judges' => $this->getJudgesListForEvent($event_id),
            ],
        ]);
    }

    private function checkIfAllJudgeHasAlreadyScored(Int $event_id, Int $squad_id)
    {
        return $this->countScoredJudges($event_id, $squad_id)->eventJudge === $this->countScoredJudges($event_id, $squad_id)->eventJudge;
    }

    private function countScoredJudges(Int $event_id, Int $squad_id)
    {

        return  DB::table('judges_scoreboards as judges_scoreboards')
                    ->join('event_criterias','event_criterias.id', '=', 'judges_scoreboards.event_criteria')
                    ->where('event_criterias.event_id', $event_id)
                    ->where('judges_scoreboards.squad_id',$squad_id)
                    ->select(DB::raw('COUNT(DISTINCT judges_scoreboards.event_judge) as eventJudge'))
                    ->first();
    }

    public function getFinalScoresFromJudgesAndCommunity(Int $event_id, Int $squad_id, Request $request)
    {
        $total = $this->applyJudgeScoreWeight($event_id, $squad_id) +
                    $this->getCommunityVotesPercentage($squad_id, $event_id) +
                    $this->getPublicVotesPercentage($squad_id, $event_id);

        if($this->checkIfAllJudgeHasAlreadyScored($event_id, $squad_id)){
            return response()->json([
                'message' => 'Results for '.$this->getSquadName($squad_id).' is not ready. Waiting for all judges to complete their votes.',
                'data'  => [
                    'squadName' => $this->getSquadName($squad_id),
                    'squadLeader' => $this->getSquadLeaderName($squad_id),
                    'judges' => $this->getJudgesListForEvent($event_id),
                ],
            ]);
        }
        return response()->json([
            'message' => 'Results for '.$this->getSquadName($squad_id),
            'data'  => [
                'squadName' => $this->getSquadName($squad_id),
                'squadLeader' => $this->getSquadLeaderName($squad_id),
                'judgeScore' => $this->applyJudgeScoreWeight($event_id, $squad_id).'%',
                'communityVotes' => $this->getCommunityVotesPercentage($squad_id, $event_id).'%',
                'publicVotes' => $this->getPublicVotesPercentage($squad_id, $event_id).'%',
                'total' => bcdiv($total, 1, 4).'%',
                'judges' => $this->getJudgesListForEvent($event_id),
            ],
        ]);
    }

    private function getSquadName(Int $squad_id){
        return Squads::find($squad_id)->name;
    }

    private function getSquadLeaderName(Int $squad_id){
        return Squads::find($squad_id)->leader->first_name. ' ' .Squads::find($squad_id)->leader->last_name;
    }

    private function getJudgeName(Int $judge_id){
       return DB::table('judges_scoreboards as js')
                    ->join('event_judges as ej','ej.id', '=', 'js.event_judge')
                    ->join('members as m','m.id', '=', 'ej.member_id')
                    ->where('js.event_judge', $judge_id)
                    ->select(DB::raw('CONCAT(m.first_name, " ", m.last_name) as name'))
                    ->first();
    }

    private function getDataFromJudgesScoreboard(Int $event_id, Int $judge_id, Int $squad_id, array $selectData)
    {
        return DB::table('judges_scoreboards as js')
                    ->join('event_criterias as ec', 'ec.id', '=', 'js.event_criteria')
                    ->join('criterias as cria','cria.id', '=', 'js.event_criteria')
                    ->join('criterions as crio', 'crio.id', '=', 'cria.criterion_id')
                    ->where('js.event_judge', $judge_id)
                    ->where('js.squad_id', $squad_id)
                    ->where('ec.event_id', $event_id)
                    ->select($selectData)
                    ->get();
    }

    private function getMaxScoreRating(Int $event_id, Int $judge_id)
    {
        return DB::table('judges_scoreboards as js')
                    ->join('event_criterias as ec', 'ec.id', '=', 'js.event_criteria')
                    ->join('criterias as cria','cria.id', '=', 'js.event_criteria')
                    ->where('ec.event_id', $event_id)
                    ->where('js.event_judge', $judge_id)
                    ->select((DB::raw('SUM(cria.max_rating) as score')))
                    ->first();
    }

    private function getRawScoreRating(Int $event_id, Int $judge_id, Int $squad_id)
    {
        return DB::table('judges_scoreboards as js')
                    ->join('event_criterias as ec', 'ec.id', '=', 'js.event_criteria')
                    ->join('criterias as cria','cria.id', '=', 'js.event_criteria')
                    ->where('js.event_judge', $judge_id)
                    ->where('js.squad_id', $squad_id)
                    ->where('ec.event_id', $event_id)
                    ->select((DB::raw('SUM(js.score) as score')))
                    ->first();
    }

    private function getJudgeRawScoreRatingBasedOnWeight(Int $event_id, Int $judge_id, Int $squad_id)
    {
        $data = DB::table('judges_scoreboards as js')
                    ->join('event_criterias as ec', 'ec.id', '=', 'js.event_criteria')
                    ->join('criterias as cria','cria.id', '=', 'js.event_criteria')
                    ->join('criterions as crio', 'crio.id', '=', 'cria.criterion_id')
                    ->join('event_judges as ej','ej.id', '=', 'js.event_judge')
                    ->where('js.event_judge', $judge_id)
                    ->where('js.squad_id', $squad_id)
                    ->where('ec.event_id', $event_id)
                    ->select('crio.criterion','cria.percentage_value','cria.min_rating','cria.max_rating','js.score')
                    ->get();

        $collection = [];
        for($i = 0; $i < count($data); $i++){
            $detailed = [
                'criterion' => $data[$i]->criterion,
                'rawScore' => $data[$i]->score/$data[$i]->max_rating * $data[$i]->percentage_value,
            ];
            array_push($collection, $detailed);
        };

        $percentage_value = 0;
        for($j = 0; $j < count($collection); $j++){
            $percentage_value += $collection[$j]['rawScore'];
        }

        array_push($collection,['percentage_value' => $percentage_value]);
        return $collection;
    }

    private function getRawScoreRatingBasedOnWeight(Int $event_id, Int $squad_id)
    {
        $data = DB::table('judges_scoreboards as js')
                    ->join('event_criterias as ec', 'ec.id', '=', 'js.event_criteria')
                    ->join('criterias as cria','cria.id', '=', 'js.event_criteria')
                    ->join('criterions as crio', 'crio.id', '=', 'cria.criterion_id')
                    ->join('members as m', 'm.id', '=', 'js.event_judge')
                    ->join('squads as s', 's.id', '=', 'js.squad_id')
                    ->where('js.squad_id', $squad_id)
                    ->where('ec.event_id', $event_id)
                    ->select('crio.criterion','cria.percentage_value','cria.min_rating','cria.max_rating','js.score', 's.name as squadName',DB::raw('CONCAT(m.first_name, " ", m.last_name) as judge'))
                    ->get();

        $collection = [];
        for($i = 0; $i < count($data); $i++){
            $detailed = [
                'squad' => $data[$i]->squadName,
                'judge' => $data[$i]->judge,
                'criterion' => $data[$i]->criterion,
                'rawScore' => $data[$i]->score/$data[$i]->max_rating * $data[$i]->percentage_value
            ];
            array_push($collection, $detailed);
        };

        $percentage_value = 0;
        for($j = 0; $j < count($collection); $j++){
            $percentage_value += $collection[$j]['rawScore'];
        }

        return $percentage_value/$this->getNumberOfJudges($event_id)->eventJudge;
    }

    private function applyJudgeScoreWeight(Int $event_id, Int $squad_id){
        $percentage_value = $this->getRawScoreRatingBasedOnWeight($event_id, $squad_id);

        return ($percentage_value /100) * Events::find($event_id)->judge_vote_percentage;
    }

    public function getNumberOfJudges(Int $event_id)
    {
        return DB::table('event_judges as event_judges')
                    ->where('event_judges.event_id', $event_id)
                    ->select(DB::raw('COUNT(DISTINCT event_judges.member_id) as eventJudge'))
                    ->first();
    }

    private function getJudgesListForEvent(Int $event_id)
    {
        return DB::table('event_judges as ej')
                ->join('members as m','m.id', '=', 'ej.member_id')
                ->select(DB::raw('CONCAT(m.first_name, " ", m.last_name) as name'), 'm.discord_username as discordUsername')
                ->get();
    }


    public function getCommunityVotesPercentage(Int $squad_id, Int $event_id)
    {
        $totalVoters = $this->getTotalVoters($event_id);
        $communityVotes = $this->getCommunityVotes($event_id,$squad_id);

        if($totalVoters->total == 0){
            return 0;
        }
        return ($communityVotes->votesReceived / $totalVoters->total) * Events::find($event_id)->member_vote_percentage;
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

    public function getPublicVotesPercentage(Int $squad_id, Int $event_id)
    {
        $totalVoters = $this->getTotalPublicVoters($event_id);
        $communityVotes = $this->getPublicVotes($event_id,$squad_id);

        if($totalVoters->total == 0){
            return 0;
        }
        $percentage_value = ($communityVotes->votesReceived / $totalVoters->total) * Events::find($event_id)->public_vote_percentage;
        return $percentage_value;
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

    public function getAllFinalScoresFromJudgesAndCommunity(Int $event_id,  Request $request)
    {
        $eventSquads = DB::table('events')
                    ->join('event_squads','event_squads.event_id', '=', 'events.id')
                    ->join('squads','squads.id', '=', 'event_squads.squad_id')
                    ->join('members','members.id', '=', 'squads.leader_id')
                    ->select('squads.id as squad_id',DB::raw('CONCAT(members.first_name, " ", members.last_name) as leaderName'),'squads.name as squadName')
                    ->get();

        $returnValue = [];

        for($i=0 ; $i < count($eventSquads) ; $i++){
            $total = $this->applyJudgeScoreWeight($event_id, $eventSquads[$i]->squad_id) +
                     $this->getCommunityVotesPercentage($eventSquads[$i]->squad_id, $event_id) +
                     $this->getPublicVotesPercentage($eventSquads[$i]->squad_id, $event_id);
            $handler = [
                'squadName' => $eventSquads[$i]->squadName,
                'squadLeader' => $eventSquads[$i]->leaderName,
                'judgeScore' => $this->applyJudgeScoreWeight($event_id, $eventSquads[$i]->squad_id).'%',
                'communityVotes' => $this->getCommunityVotesPercentage($eventSquads[$i]->squad_id, $event_id).'%',
                'publicVotes' => $this->getPublicVotesPercentage($eventSquads[$i]->squad_id, $event_id).'%',
                'total' => bcdiv($total, 1, 4).'%'
            ];

            array_push($returnValue,$handler);
        }

        return response()->json([
            'message' => 'Results for '. Events::find($event_id)->topic,
            'eventDetails' => [
                'eventTopic' => Events::find($event_id)->topic,
                'Judge Score Percentage' => Events::find($event_id)->judge_vote_percentage,
                'Community Score Percentage' => Events::find($event_id)->member_vote_percentage,
                'Public Score Percentage' => Events::find($event_id)->public_vote_percentage,
            ],
            'rating'  => $returnValue,
        ]);
    }
}

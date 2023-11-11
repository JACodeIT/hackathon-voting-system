<?php

namespace App\Http\Services;

use DB;
use App\Models\Events;

class EventsService
{
    public function getMaxScoreRating(Int $event_id, Int $judge_id)
    {
        return DB::table('judges_scoreboards as js')
                    ->join('event_criterias as ec', 'ec.id', '=', 'js.event_criteria')
                    ->join('criterias as cria','cria.id', '=', 'js.event_criteria')
                    ->where('ec.event_id', $event_id)
                    ->where('js.event_judge', $judge_id)
                    ->select((DB::raw('SUM(cria.max_rating) as score')))
                    ->first();
    }

    public function getRawScoreRating(Int $event_id, Int $judge_id, Int $squad_id)
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

    public function getJudgeRawScoreRatingBasedOnWeight(Int $event_id, Int $judge_id, Int $squad_id)
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

    public function getDataFromJudgesScoreboard(Int $event_id, Int $judge_id, Int $squad_id, array $selectData)
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

    public function getJudgeName(Int $judge_id){
        return DB::table('judges_scoreboards as js')
                     ->join('event_judges as ej','ej.id', '=', 'js.event_judge')
                     ->join('members as m','m.id', '=', 'ej.member_id')
                     ->where('js.event_judge', $judge_id)
                     ->select(DB::raw('CONCAT(m.first_name, " ", m.last_name) as name'))
                     ->first();
     }

    public function getJudgesListForEvent(Int $event_id)
    {
        return DB::table('event_judges as ej')
                ->join('members as m','m.id', '=', 'ej.member_id')
                ->select(DB::raw('CONCAT(m.first_name, " ", m.last_name) as name'), 'm.discord_username as discordUsername')
                ->get();
    }

    public function applyJudgeScoreWeight(Int $event_id, Int $squad_id){
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


    public function getCommunityVotesPercentage(Int $squad_id, Int $event_id)
    {
        $totalVoters = $this->getTotalVoters($event_id);
        $communityVotes = $this->getCommunityVotes($event_id,$squad_id);

        if($totalVoters->total == 0){
            return 0;
        }
        return ($communityVotes->votesReceived / $totalVoters->total) * Events::find($event_id)->member_vote_percentage;
    }

    public function getTotalVoters(Int $event_id)
    {
        return DB::table('community_votes')
                    ->select(DB::raw('COUNT(DISTINCT member_id) as total'))
                    ->where('event_id', $event_id)
                    ->first();
    }

    public function getCommunityVotes(Int $event_id, Int $squad_id)
    {
        return DB::table('community_votes')
                    ->select(DB::raw('COUNT(DISTINCT member_id) as votesReceived'))
                    ->where('event_id', $event_id)
                    ->where('squad_id', $squad_id)
                    ->first();
    }

    public function getTotalPublicVoters(Int $event_id)
    {
        return DB::table('public_votes')
                    ->select(DB::raw('COUNT(DISTINCT email) as total'))
                    ->where('event_id', $event_id)
                    ->first();
    }

    public function getPublicVotes(Int $event_id, Int $squad_id)
    {
        return DB::table('public_votes')
                    ->select(DB::raw('COUNT(DISTINCT email) as votesReceived'))
                    ->where('event_id', $event_id)
                    ->where('squad_id', $squad_id)
                    ->first();
    }

    public function checkIfAllJudgeHasAlreadyScored(Int $event_id, Int $squad_id)
    {
        return $this->countScoredJudges($event_id, $squad_id)->eventJudge !== $this->getNumberOfJudges($event_id)->eventJudge;
    }

    public function countScoredJudges(Int $event_id, Int $squad_id)
    {

        return  DB::table('judges_scoreboards as judges_scoreboards')
                    ->join('event_criterias','event_criterias.id', '=', 'judges_scoreboards.event_criteria')
                    ->where('event_criterias.event_id', $event_id)
                    ->where('judges_scoreboards.squad_id',$squad_id)
                    ->select(DB::raw('COUNT(DISTINCT judges_scoreboards.event_judge) as eventJudge'))
                    ->first();
    }

    public function getRawScoreRatingBasedOnWeight(Int $event_id, Int $squad_id)
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


    public function getMinAndMaxScoreRating(Int $event_id, Int $event_criteria_id)
    {
        return DB::table('event_criterias')
                        ->join('criterias', 'event_criterias.criteria_id', '=', 'criterias.id')
                        ->join('criterions','criterions.id', '=', 'criterias.criterion_id')
                        ->where('event_criterias.event_id', $event_id)
                        ->where('event_criterias.criteria_id', $event_criteria_id)
                        ->first();
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
}

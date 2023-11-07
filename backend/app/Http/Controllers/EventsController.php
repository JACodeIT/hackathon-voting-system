<?php

namespace App\Http\Controllers;

use App\Models\Events;
use App\Models\Event_Criteria;
use App\Models\Event_Judges;
use App\Models\Member;
use App\Models\Criteria;
use App\Models\Criterion;
use App\Http\Requests\StoreEventsRequest;
use App\Http\Requests\UpdateEventsRequest;

use App\Http\Resources\EventsCollection;
use Illuminate\Http\Request;

class EventsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return new EventsCollection(count($request->all()) > 0 ?
                Events::with('organizer.account', 'judges.account', 'criteria.criterion')->where('status', $request->status)->get() :
                Events::with('organizer.account', 'judges.account', 'criteria.criterion')->get());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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

        return new EventsCollection(Events::with('organizer', 'judges.account', 'criteria.criterion')
            ->where('id', $events->id)
            ->get());
    }

    /**
     * Display the specified resource.
     */
    public function show(Int $id)
    {
        return new EventsCollection(Events::with('organizer', 'judges.account', 'criteria.criterion')
            ->where('id', $id)
            ->get());
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Events $events)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEventsRequest $request, Int $id)
    {
        $input = $request->all();
        unset($input['_method']);

        Events::where('id', $id)->update($input);

        return new EventsCollection(Events::with('organizer', 'judges.account', 'criteria.criterion')
                                    ->where('id', $id)
                                    ->get());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Events $events)
    {
        //
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
}

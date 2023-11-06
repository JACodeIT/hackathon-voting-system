<?php

namespace App\Http\Controllers;

use App\Models\Events;
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
}

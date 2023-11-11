<?php

namespace App\Http\Controllers;


use App\Models\Events;
use App\Models\Event_Participants;
use Illuminate\Http\Request;

class EventParticipantsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(Int $event_id, Int $member_id, Request $request)
    {
        if(Event_Participants::where('event_id', $event_id)->where('member_id', $member_id)->exists()){
            return response()->json(['message' => 'Participant already exists'], 400);
        }

        if(Event_Participants::where('event_id', $event_id)->count() > Events::find($event_id)->maximum_registrants)
        {
            return response()->json(['message' => 'Number of maximum registrants reached'], 400);
        }

        $data = Event_Participants::create([
            'event_id' => $event_id,
            'member_id' => $member_id,
        ]);

        return response()->json([
            'message' => 'Participant was added to the event',
            'data' => $data
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Int $event_id, Int $member_id,)
    {
        if(!Event_Participants::where('event_id', $event_id)->where('member_id', $member_id)->exists()){
            return response()->json(['message' => 'Participant is not registered for this event'], 400);
        }

        Event_Participants::where('event_id', $event_id)->where('member_id', $member_id)->delete();

        return response()->json([
            'message' => 'Participant was removed from the event',
        ], 200);
    }
}

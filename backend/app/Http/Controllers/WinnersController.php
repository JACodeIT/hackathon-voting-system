<?php

namespace App\Http\Controllers;

use App\Models\Winners;
use App\Http\Requests\StoreWinnersRequest;
use App\Http\Requests\UpdateWinnersRequest;

use DB;

class WinnersController extends Controller
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
    public function store(StoreWinnersRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Winners $winners)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Winners $winners)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateWinnersRequest $request, Winners $winners)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Winners $winners)
    {
        //
    }

    public function getWinnerByEventId(Int $event_id)
    {
        $data = DB::table('winners')
                ->join('squads', 'winners.squad_id', '=', 'squads.id')
                ->join('members', 'members.id', '=', 'squads.leader_id')
                ->join('events', 'events.id', '=', 'winners.event_id')
                ->where('winners.event_id', $event_id)
                ->select('squads.name as squadName', 'winners.rank','winners.rating', 'events.topic as eventTopic', DB::raw('CONCAT (members.first_name, " ", members.last_name) as squadLeader'))
                ->get();
        return response()->json([
            'message'   => 'Winners retrieved successfully.',
            'data'      => $data
            ],200);
    }
}

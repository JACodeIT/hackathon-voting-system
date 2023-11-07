<?php

namespace App\Http\Controllers;

use App\Models\Squads;
use App\Models\Member;
use App\Models\SquadMembers;
use App\Http\Requests\StoreSquadsRequest;
use App\Http\Requests\UpdateSquadsRequest;

use App\Http\Resources\SquadsCollection;
use Illuminate\Http\Request;

class SquadsController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index(Request $request)
    {
        return new SquadsCollection(count($request->all()) > 0 ?
                Squads::with('leader','members','events')->where('status', $request->status)->get() :
                Squads::with('leader','members','events')->get());
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
    public function store(StoreSquadsRequest $request)
    {
        $squads = Squads::create([
            'leader_id'              => $request->leader_id,
            'name'                   => $request->name,
        ]);

        return response()->json([
            'message'   => $squads->name.' squad has been created.',
            'data'      =>  Squads::with('leader','members', 'events')
                            ->where('id', $squads->id)
                            ->get()
        ],200);
    }

    /**
     * Display the specified resource.
     */

    public function show(Int $id)
    {
        return new SquadsCollection(Squads::with('leader','members','events')
                                        ->where('id', $id)
                                        ->get());
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Squads $squads)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */

    public function update(UpdateSquadsRequest $request, Int $squad_id)
    {
        $input = $request->all();
        unset($input['_method']);

        Squads::where('id', $squad_id)->update($input);

        return response()->json([
            'message'   => Squads::find($squad_id)->name.' details was updated.',
            'data'      => Squads::with('leader','members', 'events')
                            ->where('id', $squad_id)
                            ->get()
        ],200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Squads $squads)
    {
        //
    }


    public function attachMemberToSquad(Int $squad_id, Request $request)
    {
        $squadMember = SquadMembers::firstOrCreate([
            'squad_id' => $squad_id,
            'member_id' => $request->member_id,
        ]);

        if(!$squadMember->wasRecentlyCreated){
            return response()->json([
                'message'   => Member::find($request->member_id)->first_name. ' is alreay a member of '. Squads::find($squad_id)->name.'.',
                'data'      => Squads::with('leader','members')
                                ->where('id', $squad_id)
                                ->get()
            ],400);
        }

        return response()->json([
            'message'   => Member::find($request->member_id)->first_name. ' was added to '. Squads::find($squad_id)->name.'.',
            'data'      => Squads::with('leader','members')
                            ->where('id', $squad_id)
                            ->get()
        ],200);
    }


    public function detachMemberToSquad(Int $squad_id, Int $member_id, Request $request)
    {
        $squadMember = SquadMembers::where('squad_id', $squad_id)
                        ->where('member_id', $member_id)
                        ->first();

        if(!empty($squadMember)){
            $squadMember->delete();

            return response()->json([
                'message'   => Member::find($member_id)->first_name. ' was removed from '. Squads::find($squad_id)->name.'.',
                'data'      => Squads::with('leader','members')
                                ->where('id', $squad_id)
                                ->get()
                ],200);
        }

        return response()->json([
            'message'   => Member::find($member_id)->first_name. ' is not a member of '. Squads::find($squad_id)->name.'.',
            'data'      => Squads::with('leader','members')
                            ->where('id', $squad_id)
                            ->get()
        ],400);
    }
}
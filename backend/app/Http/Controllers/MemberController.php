<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Http\Requests\StoreMemberRequest;
use App\Http\Requests\UpdateMemberRequest;

use App\Http\Resources\MembersCollection;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return new MembersCollection(count($request->all()) > 0 ?
                Member::with('squads','account')->where('status', $request->status)->get() :
                Member::with('squads','account')->get());
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
    public function store(StoreMemberRequest $request)
    {
        $member = Member::create([
            'user_id'                => $request->user_id,
            'first_name'             => $request->first_name,
            'middle_name'            => $request->middle_name,
            'last_name'              => $request->last_name,
            'name_extension'         => $request->name_extension,
            'github_account'         => $request->github_account,
            'discord_username'       => $request->discord_username,
            'be_rating'              => $request->be_rating,
            'fe_rating'              => $request->fe_rating,
            'ui_ux_rating'           => $request->ui_ux_rating
        ]);

        return response()->json([
            'message'   => $member->first_name.' ' . $member->last_name. ' has been registered.',
            'data'      =>  Member::with('squads','account','squads.events')
                            ->where('id', $member->id)
                            ->get()
        ],200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Int $id)
    {
        if(is_null(Member::find($id))){
            return response()->json([
                'error' => true,
                'message' => 'Member does not exist.'
            ]);
        }
        return new MembersCollection(Member::with('squads','account','squads.events')
                                        ->where('id', $id)
                                        ->get());
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Member $member)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMemberRequest $request, Int $member_id)
    {
        $input = $request->all();
        unset($input['_method']);

        Member::where('id', $member_id)->update($input);

        return response()->json([
            'message'   => Member::find($member_id)->first_name.' '.Member::find($member_id)->last_name.' details was updated.',
            'data'      => Member::with('squads','account')
                            ->where('id', $member_id)
                            ->get()
        ],200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Member $member)
    {
        //
    }
}

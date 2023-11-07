<?php

namespace App\Http\Controllers;

use App\Models\Criteria;
use App\Models\Criterion;
use App\Http\Requests\StoreCriteriaRequest;
use App\Http\Requests\UpdateCriteriaRequest;

use App\Http\Resources\CriteriaCollection;
use Illuminate\Http\Request;

class CriteriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return new CriteriaCollection(Criteria::with('criterion')->get());
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
    public function store(StoreCriteriaRequest $request)
    {
        $criteria = Criteria::create([
            'criterion_id' => $request->criterion_id,
            'min_rating' => $request->min_rating,
            'max_rating' => $request->max_rating,
            'percentage_value' => $request->percentage_value
        ]);

        return response()->json([
            'message'   => Criterion::find($request->criterion_id)->criterion. ' has been added.',
            'data'      => Criteria::where('id', $criteria->id)->get()
        ],200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Int $id)
    {
        return new CriteriaCollection(Criteria::where('id', $id)->get());
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Criteria $criteria)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCriteriaRequest $request, Int $criteria_id)
    {
        $input = $request->all();
        unset($input['_method']);

        Criteria::where('id', $criteria_id)->update($input);

        return response()->json([
            'message'   => Criterion::find($request->criterion_id)->criterion. ' has been updated.',
            'data'      => Criteria::where('id', $criteria_id)->get()
        ],200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Criteria $criteria)
    {
        //
    }
}

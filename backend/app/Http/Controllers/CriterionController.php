<?php

namespace App\Http\Controllers;

use App\Models\Criterion;
use App\Http\Requests\StoreCriterionRequest;
use App\Http\Requests\UpdateCriterionRequest;

use App\Http\Resources\CriterionCollection;
use Illuminate\Http\Request;

class CriterionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return new CriterionCollection(Criterion::all());
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
    public function store(StoreCriterionRequest $request)
    {
        $criterion = Criterion::create([
            'criterion' => $request->criterion,
            'description' => $request->description,
        ]);

        return response()->json([
            'message'   => $criterion->criterion. ' has been added.',
            'data'      => Criterion::where('id', $criterion->id)->get()
        ],200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Int $id)
    {
        return new CriterionCollection(Criterion::where('id', $id)->get());
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Criterion $criterion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCriterionRequest $request, Int $criterion_id)
    {
        $input = $request->all();
        unset($input['_method']);

        Criterion::where('id', $criterion_id)->update($input);

        return response()->json([
            'message'   => Criterion::find($criterion_id)->criterion.' details was updated.',
            'data'      => Criterion::where('id', $criterion_id)->get()
        ],200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Criterion $criterion)
    {
        //
    }
}

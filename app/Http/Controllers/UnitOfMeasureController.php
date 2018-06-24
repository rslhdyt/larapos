<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UnitOfMeasure;
use App\Http\Requests\UnitOfMeasureRequest;

class UnitOfMeasureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $unitOfMeasures = ($q = $request->get('q')) ? UnitOfMeasure::search($q) : UnitOfMeasure::query();
        $unitOfMeasures = $unitOfMeasures->paginate();

        return view('unit_of_measures.index')
            ->withUnitOfMeasures($unitOfMeasures);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('unit_of_measures.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UnitOfMeasureRequest $request)
    {
        $unitOfMeasure = UnitOfMeasure::create($request->all());

        return redirect()->route('unit-of-measures.index')
            ->withMessageSuccess('Unit of measure created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UnitOfMeasure  $unitOfMeasure
     * @return \Illuminate\Http\Response
     */
    public function show(UnitOfMeasure $unitOfMeasure)
    {
        return view('unit_of_measures.show')
            ->withUnitOfMeasure($unitOfMeasure);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UnitOfMeasure  $unitOfMeasure
     * @return \Illuminate\Http\Response
     */
    public function edit(UnitOfMeasure $unitOfMeasure)
    {
        return view('unit_of_measures.edit')
            ->withUnitOfMeasure($unitOfMeasure);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UnitOfMeasureRequest  $request
     * @param  \App\Models\UnitOfMeasure  $unitOfMeasure
     * @return \Illuminate\Http\Response
     */
    public function update(UnitOfMeasureRequest $request, UnitOfMeasure $unitOfMeasure)
    {
        $unitOfMeasure->update($request->all());

        return redirect()->route('unit-of-measures.index')
            ->withMessageSuccess('Unit of measure updated.');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function trash(Request $request)
    {
        $searchResultIds = UnitOfMeasure::search($request->get('q'))->raw()['ids'];
        $unitOfMeasures = $unitOfMeasures = ($q = $request->get('q')) ? UnitOfMeasure::whereIn('id', $searchResultIds) : UnitOfMeasure::query();
        $unitOfMeasures = $unitOfMeasures->onlyTrashed()->paginate();

        return view('unit_of_measures.trash')
            ->withUnitOfMeasures($unitOfMeasures);
    }
}

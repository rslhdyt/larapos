<?php

namespace App\Http\Controllers;

use App\Models\Adjustment;
use Illuminate\Http\Request;

class AdjustmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('adjustments.index')
            ->withAdjustments(Adjustment::orderBy('id', 'DESC')->paginate());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('adjustments.create');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Adjustment  $adjustment
     * @return \Illuminate\Http\Response
     */
    public function show(Adjustment $adjustment)
    {
        return view('adjustments.show')
            ->withAdjustment($adjustment);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Adjustment  $adjustment
     * @return \Illuminate\Http\Response
     */
    public function edit(Adjustment $adjustment)
    {
        return view('adjustments.edit')
            ->withAdjustment($adjustment);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Adjustment  $adjustment
     * @return \Illuminate\Http\Response
     */
    public function update(AdjustmentRequest $request, Adjustment $adjustment)
    {
        $adjustment->update($request->all());

        return redirect()->route('adjustments.index')
            ->withMessageSuccess('Adjustment updated.');
    }

    public function print(Adjustment $adjustment)
    {
        return view('adjustments.print')
            ->withAdjustment($adjustment);
    }
}

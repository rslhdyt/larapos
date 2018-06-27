<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use App\Models\Receiving;
use Illuminate\Http\Request;
use App\Http\Requests\ReceivingRequest;

class ReceivingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('receivings.index')
            ->withReceivings(Receiving::orderBy('id', 'DESC')->paginate());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('receivings.create');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Receiving  $receiving
     * @return \Illuminate\Http\Response
     */
    public function show(Receiving $receiving)
    {
        return view('receivings.show')
            ->withReceiving($receiving);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Receiving  $receiving
     * @return \Illuminate\Http\Response
     */
    public function edit(Receiving $receiving)
    {
        return view('receivings.edit')
            ->withReceiving($receiving)
            ->withSuppliers(Supplier::all());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Receiving  $receiving
     * @return \Illuminate\Http\Response
     */
    public function update(ReceivingRequest $request, Receiving $receiving)
    {
        $receiving->update($request->all());

        return redirect()->route('receivings.index')
            ->withMessageSuccess('Receiving updated.');
    }

    public function print(Receiving $receiving)
    {
        return view('receivings.print')
            ->withReceiving($receiving);
    }
}

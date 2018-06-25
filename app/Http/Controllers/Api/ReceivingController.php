<?php

namespace App\Http\Controllers\Api;

use App\Models\Receiving;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ReceivingRequest;

class ReceivingController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ReceivingRequest $request)
    {
        $receiving = Receiving::create($form = $request->all());
        $receiving->items()->createMany($form['items']);

        return response()->json([
            'message' => 'Receiving created.',
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Receiving  $receiving
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Receiving $receiving)
    {
        //
    }
}

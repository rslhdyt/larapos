<?php

namespace App\Http\Controllers\Api;

use App\Models\Adjustment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\AdjustmentRequest;

class AdjustmentController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdjustmentRequest $request)
    {
        $receiving = Adjustment::create($form = $request->all());
        $receiving->items()->createMany($form['items']);

        return response()->json([
            'message' => 'Adjustment created.',
        ]);
    }
}

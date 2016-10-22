<?php

namespace App\Http\Controllers;

use App\InventoryTracking;

class TrackingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'trackings' => InventoryTracking::orderBy('created_at', 'DESC')->get(),
        ];

        return view('inventories.trackings.index', $data);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

}

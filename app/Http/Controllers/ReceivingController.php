<?php

namespace App\Http\Controllers;

use App\Receiving;

class ReceivingController extends Controller
{
    public function index()
    {
        $data = [
            'receivings' => Receiving::all(),
        ];

        return view('inventories.receivings.index', $data);
    }

    public function create()
    {
        return view('inventories.receivings.create');
    }
}

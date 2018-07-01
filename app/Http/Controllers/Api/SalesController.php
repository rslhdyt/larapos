<?php

namespace App\Http\Controllers\Api;

use App\Models\Sales;
use Illuminate\Http\Request;
use App\Events\Sales\Created;
use App\Http\Controllers\Controller;
use App\Http\Requests\SalesRequest;

class SalesController extends Controller
{
    public function store(SalesRequest $request)
    {
        $sales = Sales::create($form = $request->all());
        $sales->items()->createMany($form['items']);
        $sales->payments()->createMany($form['payments']);

        event(new Created);

        return response()->json($sales, 201);
    }
}

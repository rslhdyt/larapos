<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Sale;
use App\SaleItem;
use Illuminate\Http\Request;
use Validator;

class SaleController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param App\Http\Requests $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $form = $request->all();

        $rules = Sale::$rules;
        $rules['items'] = 'required';

        $validator = Validator::make($form, $rules);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()->all(),
            ], 400);
        }

        // create object item
        $items = collect($form['items'])->map(function ($item) {
            return new SaleItem($item);
        });

        $sales = Sale::create($form);
        $sales->items()->saveMany($items);

        return response()->json([], 201);
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
        $product = Product::findOrFail($id);

        return view('products.show', compact('product'));
    }
}

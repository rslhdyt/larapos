<?php

namespace App\Http\Controllers;

use App\Sale;

class SaleController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('sales.create');
    }

    public function receipt($id)
    {
        $data = [
            'sale' => Sale::findOrFail($id),
        ];

        return view('sales.receipt', $data);
    }
}

<?php

namespace App\Http\Controllers\Api;

use App\Customer;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $keyword = $request->get('q', '');

        $products = Customer::searchByKeyword($keyword)->paginate()->appends(['q' => $keyword]);

        return response()->json($products->toArray());
    }
}

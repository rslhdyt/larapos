<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $keyword = $request->get('q', '');

        $products = Product::searchByKeyword($keyword)->paginate()->appends(['q' => $keyword]);

        return response()->json($products->toArray());
    }
}

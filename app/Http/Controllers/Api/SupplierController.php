<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $keyword = $request->get('q', '');

        $suppliers = Supplier::searchByKeyword($keyword)->paginate()->appends(['q' => $keyword]);

        return response()->json($suppliers->toArray());
    }
}

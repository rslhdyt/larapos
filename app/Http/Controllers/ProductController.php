<?php

namespace App\Http\Controllers;

use Excel;
use App\Exports\ProductExport;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\UnitOfMeasure;
use App\Http\Requests\ProductRequest;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $products = ($q = $request->get('q')) ? Product::search($q) : Product::query();
        $products = $products->paginate();

        return view('products.index')
            ->withProducts($products)
            ->withUnitOfMeasures(UnitOfMeasure::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('products.create')
            ->withUnitOfMeasures(UnitOfMeasure::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        $product = Product::create($request->all());

        return redirect()->route('products.index')
            ->withMessageSuccess('Product created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return view('products.show')
            ->withProduct($product);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return view('products.edit')
            ->withProduct($product)
            ->withUnitOfMeasures(UnitOfMeasure::all());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\ProductRequest  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, Product $product)
    {
        $product->update($request->all());

        return redirect()->route('products.index')
            ->withMessageSuccess('Product updated.');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function trash(Request $request)
    {
        $searchResultIds = Product::search($request->get('q'))->raw()['ids'];
        $products = $products = ($q = $request->get('q')) ? Product::whereIn('id', $searchResultIds) : Product::query();
        $products = $products->onlyTrashed()->paginate();

        return view('products.trash')
            ->withProducts($products);
    }

    public function export(Request $request)
    {
        return Excel::download(new ProductExport([
            'q' => $request->get('q'),
        ]), 'products.xlsx');
    }
}

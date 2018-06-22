<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;
use App\Http\Requests\SupplierRequest;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $suppliers = ($q = $request->get('q')) ? Supplier::search($q) : Supplier::query();
        $suppliers = $suppliers->paginate();

        return view('suppliers.index')
            ->withSuppliers($suppliers);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('suppliers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SupplierRequest $request)
    {
        $supplier = Supplier::create($request->all());

        return redirect()->route('suppliers.index')
            ->withMessageSuccess('Supplier created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function show(Supplier $supplier)
    {
        return view('suppliers.show')
            ->withSupplier($supplier);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function edit(Supplier $supplier)
    {
        return view('suppliers.edit')
            ->withSupplier($supplier);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\SupplierRequest  $request
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function update(SupplierRequest $request, Supplier $supplier)
    {
        $supplier->update($request->all());

        return redirect()->route('suppliers.index')
            ->withMessageSuccess('Supplier updated.');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function trash(Request $request)
    {
        $searchResultIds = Supplier::search($request->get('q'))->raw()['ids'];
        $suppliers = $suppliers = ($q = $request->get('q')) ? Supplier::whereIn('id', $searchResultIds) : Supplier::query();
        $suppliers = $suppliers->onlyTrashed()->paginate();

        return view('suppliers.trash')
            ->withSuppliers($suppliers);
    }

    public function export(Request $request)
    {
        return Excel::download(new SupplierExport([
            'q' => $request->get('q'),
        ]), 'suppliers.xlsx');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Http\Requests\CustomerRequest;
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
        $customers = ($q = $request->get('q')) ? Customer::search($q) : Customer::query();
        $customers = $customers->paginate();

        return view('customers.index')
            ->withCustomers($customers);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('customers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CustomerRequest $request)
    {
        $customer = Customer::create($request->all());

        return redirect()->route('customers.index')
            ->withMessageSuccess('Customer created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        return view('customers.show')
            ->withCustomer($customer);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {
        return view('customers.edit')
            ->withCustomer($customer);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\CustomerRequest  $request
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(CustomerRequest $request, Customer $customer)
    {
        $customer->update($request->all());

        return redirect()->route('customers.index')
            ->withMessageSuccess('Customer updated.');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function trash(Request $request)
    {
        $searchResultIds = Customer::search($request->get('q'))->raw()['ids'];
        $customers = $customers = ($q = $request->get('q')) ? Customer::whereIn('id', $searchResultIds) : Customer::query();
        $customers = $customers->onlyTrashed()->paginate();

        return view('customers.trash')
            ->withCustomers($customers);
    }

    public function export(Request $request)
    {
        return Excel::download(new CustomerExport([
            'q' => $request->get('q'),
        ]), 'customers.xlsx');
    }
}

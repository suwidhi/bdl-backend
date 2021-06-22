<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Customer::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'string|required|max:120',
            'phone' => 'string|max:15',
            'gender' => 'string',
            'income' => 'string',
            'account' => 'integer|required'
        ]);

        return Customer::create($validated);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Customer::where('id', $id)->first();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'string|required|max:120',
            'phone' => 'string|max:15',
            'gender' => 'string',
            'income' => 'string',
            'account' => 'integer|required'
        ]);

        $customer = Customer::where('id', $id)->first();

        $customer->name = $validated['name'];
        $customer->phone = $validated['phone'];
        $customer->gender = $validated['gender'];
        $customer->income = $validated['income'];
        $customer->account = $validated['account'];

        return $customer->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        return $customer->delete();
    }
}

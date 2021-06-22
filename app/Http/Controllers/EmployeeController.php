<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Dealer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Employee::all();
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
            'type' => 'integer|required',
            'name' => 'string|required|max:120',
            'email' => 'email|required',
            'phone' => 'string|required|max:15',
            'dealer' => 'integer|required',
            'working_date' => 'string|required',
            'address' => 'string'
        ]);

        return Employee::create([
            'type' => $validated['type'],
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'dealer' => $validated['dealer'],
            'working_date' => $validated['working_date'],
            'address' => $validated['address']
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $employee = Employee::where('id', $id)->first();
        return $employee;  
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'type' => 'integer|required',
            'name' => 'string|required|max:120',
            'email' => 'email|required',
            'phone' => 'string|required|max:15',
            'working_date' => 'string|required',
            'address' => 'string'
        ]);

        $employee = Employee::where('id', $id)->first();

        $employee->type = $validated['type'];
        $employee->name = $validated['name'];
        $employee->email = $validated['email'];
        $employee->phone = $validated['phone'];
        $employee->working_date = $validated['working_date'];
        $employee->address = $validated['address'];

        return $employee->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $employee = Employee::where('id', $id)->first();
        return $employee->delete();
    }
}

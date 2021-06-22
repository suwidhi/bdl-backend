<?php

namespace App\Http\Controllers;

use App\Models\TransactionCar;
use App\Models\Car;
use Illuminate\Http\Request;

class TransactionCarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transaction = TransactionCar::all();

        return $transaction;
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
            'transaction' => 'integer|required',
            'car' => 'string|required|unique'
        ]);

        return TransactionCar::create([
            'transaction' => $validated['transaction'],
            'car' => $validated['car']
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TransactionCar  $transactionCar
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $transaction = TransactionCar::where('id', $id)->get();
        $cars = [];

        if($transaction){

            foreach($transaction as $row){
                $car += Car::where('id', $row->car)->first();
            }
        }
        return $cars;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TransactionCar  $transactionCar
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TransactionCar $transactionCar)
    {
        // do nothing for ease of life
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TransactionCar  $transactionCar
     * @return \Illuminate\Http\Response
     */
    public function destroy(TransactionCar $transactionCar)
    {
        // you wanted to delete transaction, that's against the law
    }
}

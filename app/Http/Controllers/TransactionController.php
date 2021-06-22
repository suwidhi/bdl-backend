<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Dealer;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Transaction::all();
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
            'dealer' => 'integer|required',
            'employee' => 'integer|required',
            'type' => 'integer|required',
            'model' => 'integer|required',
            'amount' => 'integer|min:1|max:100|required',
            'status' => 'integer|required',
        ]);

        return Transaction::create([
            'dealer' => $validated['dealer'],
            'employee' => $validated['employee'],
            'type' => $validated['type'],
            'model' => $validated['model'],
            'amount' => $validated['amount'],
            'status' => $validated['status']
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transaction)
    {
        return Transaction::find(
            $transaction
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaction $transaction)
    {
        $validated = $request->validate([
            'dealer' => 'integer',
            'employee' => 'integer',
            'type' => 'integer',
            'model' => 'integer',
            'amount' => 'integer|min:1|max:100',
            'status' => 'integer',
        ]);

        $transaction->fill($validated);

        return $transaction->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaction)
    {
        return $transaction->delete();
    }
}

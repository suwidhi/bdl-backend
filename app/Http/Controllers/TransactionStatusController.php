<?php

namespace App\Http\Controllers;

use App\Models\TransactionStatus;
use Illuminate\Http\Request;

class TransactionStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return TransactionStatus::all();
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
            'name' => 'string|required|max:120'
        ]);

        return TransactionStatus::create([
            'name' => $validated['name']
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TransactionStatus  $transactionStatus
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return TransactionStatus::where('id', $id)->first();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TransactionStatus  $transactionStatus
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'string|required|max:120'
        ]);

        $transactionStatus = TransactionStatus::where('id', $id)->first();

        $transactionStatus->name = $validated['name'];
        return $transactionStatus->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TransactionStatus  $transactionStatus
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $transactionStatus = TransactionStatus::where('id', $id)->first();
        return $transactionStatus->delete();
    }
}

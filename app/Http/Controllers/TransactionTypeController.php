<?php

namespace App\Http\Controllers;

use App\Models\TransactionType;
use Illuminate\Http\Request;

class TransactionTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return TransactionType::all();
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

        return TransactionType::create([
            'name' => $validated['name']
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TransactionType  $transactionType
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return TransactionType::where('id', $id)->first();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TransactionType  $transactionType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'string|required|max:120'
        ]);

        $transactionType = TransactionType::where('id', $id)->first();

        $transactionType->name = $validated['name'];

        return $transactionType->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TranscationType  $transcationType
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $transactionType = TransactionType::where('id', $id)->first();
        return $transactionType->delete();
    }
}

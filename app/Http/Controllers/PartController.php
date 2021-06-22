<?php

namespace App\Http\Controllers;

use App\Models\Part;
use Illuminate\Http\Request;

class PartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Part::all();
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
            'code' => 'string|required|max:120',
            'supplier' => 'integer',
            'manufacturer' => 'integer',
            'name' => 'string|required',
            'model' => 'integer|required',
            'description' => 'string'
        ]);

        return Part::create([
            'code' => $validated['code'],
            'supplier' => $validated['supplier'] != 0 ? $validated['supplier'] : null,
            'manufacturer' => $validated['manufacturer'] != 0 ? $validated['manufacturer'] : null,
            'name' => $validated['name'],
            'model' => $validated['model'],
            'description' => $validated['description']
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Part  $part
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Part::where('code', $id)->first();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Part  $part
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'code' => 'string|required|max:120',
            'supplier' => 'integer',
            'manufacturer' => 'integer',
            'name' => 'string|required',
            'model' => 'integer|required',
            'description' => 'string'
        ]);

        $part = Part::where('code', $id)->first();

        $part->code = $validated['code'];
        $part->supplier = $validated['supplier'] != 0 ? $validated['supplier'] : null;
        $part->name = $validated['name'];
        $part->manufacturer = $validated['manufacturer'] != 0 ? $validated['manufacturer'] : null;
        $part->model = $validated['model'];
        $part->description = $validated['description'];

        return $part->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Part  $part
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $part = Part::where('code', $id)->first();
        return $part->delete();
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\CarOption;
use Illuminate\Http\Request;

class CarOptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return CarOption::all();
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
            'engine' => '   |required|max:120',
            'color' => 'string|required|max:60',
            'transmission' => 'string|required|max:60'
        ]);

        return CarOption::create([
            'engine' => $validated['engine'],
            'color' => $validated['color'],
            'transmission' => $validated['transmission']
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CarOption  $carOption
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $carOption = CarOption::where('id', $id)->first();

        return $carOption;

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CarOption  $carOption
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'engine' => 'string|required|max:120',
            'color' => 'string|required|max:60',
            'transmission' => 'string|required|max:60'
        ]);

        $carOption = CarOption::where('id', $id)->first();

        $carOption->engine = $validated['engine'];
        $carOption->color = $validated['color'];
        $carOption->transmission = $validated['transmission'];

        return $carOption->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CarOption  $carOption
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $carOption = CarOption::where('id', $id)->first();
        return $carOption->delete();
    }
}

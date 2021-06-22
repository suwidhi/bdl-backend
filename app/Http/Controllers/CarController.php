<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\TransactionCar;
use App\Models\Transaction;
use App\Models\Inventory;
use Illuminate\Http\Request;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Car::all();
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
            'amount' => 'integer|min:1|max:100',
            'brand' => 'integer|required',
            'type' => 'integer|required',
            'model' => 'integer|required',
            'option' => 'integer|required',
            'price' => 'string|required',
        ]);

        $amount = intval($validated['amount']);
        $initial = Car::count();
        $return = [];

        for($i = 0; $i < $amount; ++$i){
            array_push($return, Car::create([
                'vin' => strtoupper(substr(md5($initial + $i), -10)),
                'brand' => $validated['brand'],
                'type' => $validated['type'],
                'model' => $validated['model'],
                'option' => $validated['option'],
                'price' => $validated['price']
            ]));
        }
        return $return;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function show(Car $car)
    {
        return Car::find($car);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Car $car)
    {
        $validated = $request->validate([
            'brand' => 'integer|required',
            'type' => 'integer|required',
            'model' => 'integer|required',
            'option' => 'integer|required',
            'price' => 'string|required',
            'transfered' => 'boolean'
        ]);

        $car->fill($validated);

        return $car->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function destroy(Car $car)
    {
        return $car->delete();
    }


    /**
     * get the car of particular model
     * 
     */

     public function transfer(Request $request, $transaction, $model, $amount){
         $result = Car::where('model', $model)->where('transfered', false)->limit($amount)->get();

         if(count($result) < $amount){
            return response([], 422);
         }

         // set all car transfer status and insert into transaction car along the way
         foreach($result as $car){
            TransactionCar::create([
                'transaction' => $transaction,
                'car' => $car->vin
            ]);

            $car->transfered = true;
            $car->save();

            // do not forget about inventory...
            Inventory::create([
                'dealer' => Transaction::where('id', $transaction)->first()->dealer,
                'car' => $car->vin
            ]);
         }

         return $result;
     }
}

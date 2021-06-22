<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Sales;
use App\Models\Customer;
use App\Models\Inventory;

class StoreController extends Controller
{
    public function products(Request $request){
        return DB::table('inventories')
        ->select(DB::raw('inventories.dealer as dealer_id, cars.model as model_id, dealers.name as dealer, cars.price, brands.name as brand, car_models.name as model, count(dealers.name) as stock'))
        ->join('dealers', 'dealers.id', '=', 'inventories.dealer')
        ->join('cars', 'cars.vin', '=', 'inventories.car')
        ->join('brands', 'cars.brand', '=', 'brands.id')
        ->join('car_models', 'car_models.id', '=', 'cars.model')
        ->groupBy('dealers.name')
        ->groupBy('car_models.name')
        ->groupBy('brands.name')
        ->groupBy('cars.price')
        ->groupBy('cars.model')
        ->groupBy('inventories.dealer')
        ->where('inventories.sold', '=', false)
        ->get();
    }

    public function getOne(Request $request, $dealer, $model){
        return DB::table('inventories')
        ->select(DB::raw('inventories.id as inv_id, cars.vin as car, dealers.name, cars.price'))
        ->join('dealers', 'inventories.dealer', '=', 'dealers.id')
        ->join('cars', 'cars.vin', '=', 'inventories.car')
        ->where('inventories.sold', '=', 0)
        ->where('cars.model', '=', $model)
        ->get();
    }

    public function purchase(Request $request){
        $customer = Customer::where('account', $request->customer)->first()->id;
        return Sales::create([
            'customer' => $customer,
            'inventory' => $request->inventory
        ]);
    }

    public function unpaid(Request $request, $uid){
        $customer = Customer::where('account', $uid)->first()->id;

        return DB::table('sales')
        ->select(DB::raw('sales.id as sales_id, customer as customer_id, inventory as inventory_id
        , customers.name as customer, dealers.name as dealer, dealers.id as dealer_id, sales.created_at
        , cars.vin, sales.paid'))
        ->join('customers', 'customers.id','=', 'sales.customer')
        ->join('inventories', 'inventories.id','=', 'sales.inventory')
        ->join('dealers', 'dealers.id','=', 'inventories.dealer')
        ->join('cars', 'cars.vin','=', 'inventories.car')
        ->where('sales.customer', '=', $customer)
        ->get();
    }

    public function pay(Request $request, $inventory, $sale){
        $sale = Sales::where('id', $sale)->first();
        $inventory = Inventory::where('id', $inventory)->first();

        $sale->paid = true;
        $inventory->sold = true;
        $sale->save();
        $inventory->save();

        return response([
            'sale' => $sale,
            'inventory' => $inventory
        ]);
    }
}

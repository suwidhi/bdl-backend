<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{

    public function topBrands(){
        return DB::table('sales')
        ->select(DB::raw('brands.name as brand, count(brands.name) as total'))
        ->join('inventories', 'inventories.id', '=', 'sales.inventory')
        ->join('cars', 'cars.vin', '=', 'inventories.car')
        ->join('brands', 'brands.id', '=', 'cars.brand')
        ->where('sales.paid', '=', true)
        ->groupBy('brands.name')
        ->orderBy('total')
        ->get();
    }

    public function topUnitsSell(){
        return DB::table('sales')
        ->select(DB::raw('brands.name as brand, sum(cars.price) as total'))
        ->join('inventories', 'inventories.id', '=', 'sales.inventory')
        ->join('cars', 'cars.vin', '=', 'inventories.car')
        ->join('brands', 'brands.id', '=', 'cars.brand')
        ->where('sales.paid', '=', true)
        ->groupBy('brands.name')
        ->orderBy('total')
        ->get();
    }

    
}

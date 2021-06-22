<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;

use App\Http\Controllers\BrandController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\CarModelController;
use App\Http\Controllers\CarOptionController;
use App\Http\Controllers\CarTypeController;
use App\Http\Controllers\DealerController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\EmployeeTypeController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ManufacturerController;
use App\Http\Controllers\PartController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\TransactionCarController;
use App\Http\Controllers\TransactionStatusController;
use App\Http\Controllers\TransactionTypeController;
use App\Http\Controllers\UserTypeController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\ReportController;


use App\Http\Controllers\ManageUserController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::post('/login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);
Route::get('/persistent', [AuthController::class, 'createSession'])->middleware('auth:sanctum');

// Unauth
Route::get('/login', function(){
    return response([
        'message' => 'Unauthorized'
    ], 401);
})->name('login');

/*
Privilege yang di implementasikan
1 = Root
2 = Admin
3 = User
4 = Guest
*/

// Group for changing password and name but lets not email
// Route::group(['middleware' => ['auth:sanctum', 'priv:1', 'priv:2', 'priv:3']], function(){
    Route::post('/update', [AuthController::class, 'update']);
    Route::resource('users', UserController::class);

// });
Route::resource('uss', ManageUserController::class);

// Root group
// Route::group(['middleware' => ['auth:sanctum', 'priv:1']], function(){
    Route::resource('admins', AdminController::class)->except(['update']);
    Route::resource('usertypes', UserTypeController::class);
    Route::get('/accounts/{type}', [AdminController::class, 'accounts']);
// });

 Route::group(['middleware' => ['auth:sanctum']], function(){
    //Brand
    Route::resource('brands', BrandController::class);

    // Car
    Route::resource('cars', CarController::class);

    // CarOption
    Route::resource('carmodels', CarModelController::class);

    // CarOption
    Route::resource('caroptions', CarOptionController::class);

    // CarType
    Route::resource('cartypes', CarTypeController::class);

    // Dealer
    Route::resource('dealers', DealerController::class);

    // Employee
    Route::resource('employees', EmployeeController::class);

    // EmployeeType
    Route::resource('employeetypes', EmployeeTypeController::class);

    // Manufacturer
    Route::resource('manufacturers', ManufacturerController::class);

        // // Model
        // Route::resource('models', CarModelController::class);

    // Part
    Route::resource('parts', PartController::class);

    // Supplier
    Route::resource('suppliers', SupplierController::class);

    // Transaction
    Route::resource('transactions', TransactionController::class);

    // TransactionStatus
    Route::resource('transactionstatuses', TransactionStatusController::class);

    // TranscationType
    Route::resource('transactiontypes', TransactionTypeController::class);

    Route::resource('transactioncars', TransactionCarController::class)->except(['update', 'destroy']);

    // Inventories
    Route::resource('inventories', InventoryController::class);

    Route::post('/purchase', [StoreController::class, 'purchase']);

    // Sales
    Route::resource('sales', SalesController::class);
 });

Route::post('/register', [AuthController::class, 'register']);

Route::get('/transfer/{transaction}/{model}/{amount}', [CarController::class, 'transfer']);


Route::get('/products', [StoreController::class, 'products']);
Route::get('/getone/{dealer}/{model}', [StoreController::class, 'getOne']);

// Customer
Route::resource('customers', CustomerController::class);

Route::get('/unpaid/{uid}', [StoreController::class, 'unpaid']);
Route::post('/pay/{inventory}/{sale}', [StoreController::class, 'pay']);

Route::get('/topbrands', [ReportController::class, 'topBrands']);
Route::get('/topunits', [ReportController::class, 'topUnitsSell']);
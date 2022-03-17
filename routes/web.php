<?php

use App\Http\Controllers\Products\ProductsImportController;
use App\Http\Controllers\Users\UsersImportController;
use Illuminate\Support\Facades\Route;
use PHPUnit\TextUI\XmlConfiguration\Group;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
//Users routes
Route::group(
    ['namespace' => 'Users', 'prefix' => 'users', 'as' => 'users.', 'middleware' => []],
    function () {
        Route::get('/', function (){return view('Users.home');});
        Route::get('/import', [UsersImportController::class,'show']);
        Route::post('/import',[UsersImportController::class,'store']);
    }
);
Route::group(
    ['namespace' => 'Products', 'prefix' => 'products', 'as' => 'products.', 'middleware' => []],
    function () {
        Route::get('/', function (){return "products";});
        Route::get('/import', [ProductsImportController::class,'show']);
        Route::post('/import',[ProductsImportController::class,'store']);
        Route::post('/update',[ProductsImportController::class,'update']);

    }
);
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

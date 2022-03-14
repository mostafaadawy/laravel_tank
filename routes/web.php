<?php

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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

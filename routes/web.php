<?php

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
    ['namespace' => 'Users', 'prefix' => 'users', 'as' => 'usesr.', 'middleware' => []],
    function () {
        Route::get('/', function (){return view('Users.home');});
    }
);
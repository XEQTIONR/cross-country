<?php

use App\Http\Controllers\ConsignmentController;
use App\Http\Controllers\ContainerController;
use App\Http\Controllers\LcController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\TyreController;
use Illuminate\Support\Facades\Route;
use TCG\Voyager\Facades\Voyager;
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

Route::resource('lcs', LcController::class);

Route::resource('consignments', ConsignmentController::class);

Route::resource('containers', ContainerController::class);

Route::resource('orders', OrderController::class);

Route::resource('tyres', TyreController::class);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';


Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});

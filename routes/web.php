<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
/*Route::get('/', function () {
    return view('auth.login');
});*/
Route::get('/', function () {
    return view('auth.login');
});
     
Route::get('/',[App\Http\Controllers\HomebudgetController::class, 'index'])->name('index');
Route::post('/post',[App\Http\Controllers\HomebudgetController::class, 'store'])->name('store');
Route::get('/edit/{id}',[App\Http\Controllers\HomebudgetController::class, 'edit'])->name('homebudget.edit');
Route::put('/update',[App\Http\Controllers\HomebudgetController::class, 'update'])->name('homebudget.update');
Route::post('/destroy/{id}',[App\Http\Controllers\HomebudgetController::class, 'destroy'])->name('homebudget.destroy');

Auth::routes();


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

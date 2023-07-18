<?php

use Illuminate\Support\Facades\Route;

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
use App\Http\Controllers\EventController;

Route::get('/',  [EventController::class,'index']);
Route::get('/events/create', [EventController::class,'create'])->middleware('auth');
Route::get('/events/{id}',  [EventController::class,'show']); //recebe ID do front-end, acessa a rota show (padrão laravel)
Route::post('/events',   [EventController::class,'store']);  //view store é padrão Laravel
Route::delete('/events/{id}',[EventController::class,'destroy'])->middleware('auth'); //Recebe o ID,e podera usar o metodo DELETE para o usuario autenticado
Route::get('/events/edit/{id}',[EventController::class,'edit'])->middleware('auth');//Recebe o ID,e podera usar o metodo UPDATE para o usuario autenticado
Route::put('/events/update/{id}',[EventController::class,'update'])->middleware('auth');
Route::get('/dashboard',[EventController::class,'dashboard'])->middleware('auth');




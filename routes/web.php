<?php

use App\Http\Controllers\PetController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/pets', [PetController::class, 'index']);
Route::get('/pets/create', [PetController::class, 'create']);
Route::post('/pets', [PetController::class, 'store']);
Route::get('/pets/{pet}', [PetController::class, 'show']);
Route::put('/pets/{pet}', [PetController::class, 'update']);
Route::delete('/pets/{pet}', [PetController::class, 'destroy']);
Route::get('/pets/{pet}/edit', [PetController::class, 'edit']);

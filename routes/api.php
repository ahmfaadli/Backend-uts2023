<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PegawaiController;
/*

|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/employees', [PegawaiController::class, "index"]);
Route::post('/employees', [PegawaiController::class, "store"]);
Route::get('/employees/{id}', [PegawaiController::class, "show"]);
Route::put('/employees/{id}', [PegawaiController::class, "update"]);
Route::delete('/employees/{id}', [PegawaiController::class, "destroy"]);
Route::get('/employees/search/{name}', [PegawaiController::class, "search"]);
Route::get('/employees/status/active', [PegawaiController::class, "active"]);
Route::get('/employees/status/inactive', [PegawaiController::class, "inactive"]);
Route::get('/employees/status/terminated', [PegawaiController::class, "terminated"]);


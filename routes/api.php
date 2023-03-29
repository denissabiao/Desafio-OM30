<?php

use App\Http\Controllers\{
    AuthController,
    PatientController,
    AddressController
};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
Route::post('/register', [AuthController::class, 'register']);
Route::get('/zipcode/{zip_code}', [AddressController::class, 'zipCode']);

Route::middleware('auth:sanctum')->prefix('patient')->group(function () {
    Route::get('/filter', [PatientController::class, 'filter']);
    Route::post('/import', [PatientController::class, 'import']);
});

Route::middleware('auth:sanctum')->apiResource('patient', PatientController::class)->only('store', 'update', 'show', 'destroy');

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
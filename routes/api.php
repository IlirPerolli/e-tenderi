<?php

use App\Http\Controllers\API\V1\Auth\LoginController;
use App\Http\Controllers\API\V1\Auth\RegisterController;
use App\Http\Controllers\API\V1\Tenders\TendersCreateController;
use App\Http\Controllers\API\V1\Tenders\TendersShowController;
use App\Http\Controllers\API\V1\Jobs\JobsCreateController;
use App\Http\Controllers\API\V1\Jobs\JobsShowController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::post('/register', RegisterController::class);
Route::post('/login', LoginController::class);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/tenders', TendersCreateController::class);
Route::get('/tenders', TendersShowController::class);

Route::post('/jobs', JobsCreateController::class);
Route::get('/jobs', JobsShowController::class);


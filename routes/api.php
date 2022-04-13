<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DispositifController;
use App\Http\Controllers\AssignationController;
use App\Http\Controllers\PersonneVulnerableController;
use App\Http\Controllers\PersonneAffileeController;
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
Route::apiResource('/Dispositifs',DispositifController::class);
Route::apiResource('/Assignations',AssignationController::class);

Route::apiResource('/PersoonnesVulnerales',PersonneVulnerableController::class);
Route::apiResource('/PersoonnesAffilee',PersonneAffileeController::class);

Route::resource('personne',PersonneVulnerableController::class);





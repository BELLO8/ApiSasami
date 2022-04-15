<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\PersonneVulnerableController;
use App\Http\Controllers\API\SurveillerController;
use App\Http\Controllers\API\ProfillingController;
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
Route::group([
    'prefix' => 'v1'
  ], function () {
       Route::resource('personne',PersonneVulnerableController::class);
       Route::resource('profilling',ProfillingController::class);
       Route::resource('surveiller',SurveillerController::class);
    }
);






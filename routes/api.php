<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DispositifController;
use App\Http\Controllers\AssignationController;
use App\Http\Controllers\PersonneVulnerableController;
use App\Http\Controllers\PersonneAffileeController;
use App\Http\Controllers\IncidentController;
use App\Http\Controllers\ProfillingController;
use App\Http\Controllers\AlertController;

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

Route::apiResource('/PersonnesVulnerales',PersonneVulnerableController::class);

Route::apiResource('/PersonnesAffilee',PersonneAffileeController::class);

Route::apiResource('/Incidents',IncidentController::class);

Route::apiResource('/Alerte',AlertController::class);

Route::resource('/Profilling',ProfillingController::class);

Route::get("/countAlerte",[AlertController::class,"count"]);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::group([
//     'prefix' => 'AlassaneApi'
//   ], function () {
//        Route::resource('personne',PersonneVulnerableController::class);
//        Route::resource('profilling',ProfillingController::class);
//     }
// );


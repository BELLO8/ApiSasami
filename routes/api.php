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
use App\Http\Controllers\ServiceUrgenceController;
use App\Http\Controllers\ConstanteController;
use App\Http\Controllers\SurveillerController;

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

Route::apiResource('/Profilling',ProfillingController::class);

Route::apiResource('/ServiceUrgences',ServiceUrgenceController::class);

Route::get("/NombreAlerte",[AlertController::class,"count"]);

Route::apiResource('Constante', ConstanteController::class);

Route::apiResource('surveiller',SurveillerController::class);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


// Route::group([
//     'prefix' => 'v1'
//   ], function () {
//        Route::resource('personne',PersonneVulnerableController::class);
//        Route::resource('profilling',ProfillingController::class);
//        Route::resource('surveiller',SurveillerController::class);
//     }
// );






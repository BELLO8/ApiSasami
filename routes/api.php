<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AlertController;
use App\Http\Controllers\IncidentController;
use App\Http\Controllers\ConstanteController;
use App\Http\Controllers\DispositifController;
use App\Http\Controllers\ProfillingController;
use App\Http\Controllers\SurveillerController;
use App\Http\Controllers\AssignationController;
use App\Http\Controllers\ServiceUrgenceController;
use App\Http\Controllers\PersonneAffileeController;
use App\Http\Controllers\PersonneVulnerableController;


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

Route::post('/register', [AuthController::class, 'register']);

Route::post('/login', [AuthController::class, 'login']);


Route::apiResource('/Assignations', AssignationController::class);

Route::apiResource('/PersonnesVulnerales', PersonneVulnerableController::class);

Route::apiResource('/PersonnesAffilee', PersonneAffileeController::class);

Route::apiResource('/Incidents', IncidentController::class);

Route::apiResource('/Alerte', AlertController::class);

Route::apiResource('/Profilling', ProfillingController::class);

Route::apiResource('/ServiceUrgences', ServiceUrgenceController::class);

Route::get("/NombreAlerte", [AlertController::class, "count"]);

Route::apiResource('Constante', ConstanteController::class);

Route::apiResource('Surveiller', SurveillerController::class);


Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/profile', function (Request $request) {
        return auth()->user();
    });

    Route::post('/logout', [AuthController::class, 'logout']);
});

//personne vulnerable
Route::group([
    'middleware' => ['IsVulnerable','auth:sanctum']
  ], function(){
    Route::get('/profileVulnerable', function (Request $request) {
        return auth()->user();
    });
  });

//personne affiliée
Route::group([
    'middleware' => ['IsAffiliee','auth:sanctum']
  ], function(){
    Route::get('/profileAffiliee', function (Request $request) {
        return auth()->user();
    });
  });

  //Administrateur
  Route::group([
    'middleware' => ['IsAdmin','auth:sanctum']
  ], function(){

    Route::apiResource('/Dispositifs', DispositifController::class);

    Route::get('/profileAdmin', function (Request $request) {
        return auth()->user();
    });
  });
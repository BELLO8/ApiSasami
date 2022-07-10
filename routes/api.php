<?php

use Illuminate\Http\Request;
use App\Events\EventConstante;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AlertController;
use App\Http\Controllers\FicheController;
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



Route::apiResource('/Assignations', AssignationController::class);

Route::apiResource('/PersonnesVulnerales', PersonneVulnerableController::class);

Route::apiResource('/PersonnesAffilee', PersonneAffileeController::class);

Route::apiResource('/Incidents', IncidentController::class);

Route::apiResource('/Alerte', AlertController::class);

Route::apiResource('/Profilling', ProfillingController::class);

Route::apiResource('/ServiceUrgences', ServiceUrgenceController::class);

//counters
Route::get("/NombreAlerte", [AlertController::class, "count"]);

Route::get("/NombreDispositif", [DispositifController::class, "count"]);

Route::get("/NombreService", [ServiceUrgenceController::class, "count"]);

Route::get("/NombreIncident", [IncidentController::class, "count"]);
//
Route::apiResource('LesFicheMedicales', FicheController::class);

Route::apiResource('Constante', ConstanteController::class);

Route::apiResource('Surveiller', SurveillerController::class);

Route::apiResource('/Dispositifs', DispositifController::class);

Route::post('/register', [AuthController::class, 'register']);

Route::post('/login', [AuthController::class, 'login']);

Route::post('/UserRegister', [AuthController::class, 'UserRegister']);

Route::get('/AllUsers', [AuthController::class,'getUsers']);

Route::get('/User/{id}', [AuthController::class,'getUsersById']);

Route::put('/UpdateUsers/{id}', [AuthController::class, 'UpdateUsers']);

Route::post('/SendNotification', [AlertController::class, 'sendWebNotification']);

//service hospitalier
Route::group([
    'middleware' => ['auth:sanctum', 'IsServicehospitalier']
  ], function(){
    
    Route::get('/profileServiceHospitalier', function (Request $request) {
        if(Auth::user()->role =='service_hopital'){
            return auth()->user();
        }
    });
    Route::post('/logout', [AuthController::class, 'logout']);
  });




//service urgences
Route::group([
    'middleware' => ['auth:sanctum', 'IsService']
  ], function(){

    Route::apiResource('/Assignations', AssignationController::class);

    Route::get('/profileServiceUrgence', function (Request $request) {
        if(Auth::user()->role =='vulnérable'){
            return auth()->user();
        }
    });
    Route::post('/logout', [AuthController::class, 'logout']);
  });

//personne vulnerable
Route::group([
    'middleware' => ['IsVulnerable','auth:sanctum']
  ], function(){

    Route::apiResource('/Assignations', AssignationController::class);

    Route::get('/MonDispositif',[AssignationController::class,'show']);

    Route::get('/profileVulnerable', function (Request $request) {
        if(Auth::user()->role =='vulnerable'){
            return auth()->user();
        }
    });

    Route::get('MaFicheMedicale', [FicheController::class,'show']);

    Route::put('MaFicheMedicale', [FicheController::class,'updateMaFiche']);

    Route::post('AddFiche', [FicheController::class,'store']);

    Route::put('AddFiche/{id}', [FicheController::class,'update']);

    Route::post('/logout', [AuthController::class, 'logout']);
  });


//personne affiliée
Route::group([
    'middleware' => ['IsAffiliee','auth:sanctum']
  ], function(){
    Route::get('/profileAffiliee', function (Request $request) {
        if(Auth::user()->role =='affiliée'){
            return auth()->user();
        }
    });
    Route::get('/Suivre',[SurveillerController::class,'show']);
    Route::post('/logout', [AuthController::class, 'logout']);
  });

  //Administrateur
  Route::group([
    'middleware' => ['IsAdmin','auth:sanctum']
  ], function(){

    Route::get('/profileAdmin', function (Request $request) {
        if(Auth::user()->role =='admin'){
            return auth()->user();
        }
    });

    Route::post('/logout', [AuthController::class, 'logout']);
  });

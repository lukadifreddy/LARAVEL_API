<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AdresseController;
use App\Http\Controllers\Api\AgenceController;
use App\Http\Controllers\Api\AgentController;
use App\Http\Controllers\Api\ClientController;
use App\Http\Controllers\Api\ExterneController;
use App\Http\Controllers\Api\OperationController;
use App\Http\Controllers\Api\UtilisateurController;
use routes\api;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/test',function(){
    $tableau = array (
        "fruits"  => array("nom" => "orange", "b" => "banana", "c" => "apple"),
        "numbers" => array(1, 2, 3, 4, 5, 6),
        "holes"   => array("first", 5 => "second", "third")
    );
    return response()->json($tableau,200);
});
// les routes vers les differents elements adresse
Route::get('/adresses',[AdresseController::class,"index"]);
Route::post('/adresses/create',[AdresseController::class,"create"]);
Route::put('/adresses/editor/{Adresse}',[AdresseController::class,"editor"]);
Route::delete('/adresses/delete/{Adresse}',[AdresseController::class,"delete"]);

// les routes vers les differents elements agence
Route::get('/agence',[agenceController::class,"index"]);
Route::post('/agences/create',[agenceController::class,"create"]);
Route::put('/agences/editor/{Agence}',[agenceController::class,"editor"]);
Route::delete('/agences/delete/{Agence}',[AgenceController::class,"delete"]);

// les routes vers les differents elements agent
Route::get('/agent',[agenceController::class,"index"]);
Route::post('/agents/create',[agentController::class,"create"]);
Route::put('/agents/editor/{Adresse}',[agentController::class,"editor"]);
Route::delete('/agents/delete/{Adresse}',[AgentController::class,"delete"]);

// les routes vers les differents elements client
Route::get('/client',[clientController::class,"index"]);
Route::post('/clients/create',[clientController::class,"create"]);
Route::put('/clients/editor/{Adresse}',[clientController::class,"editor"]);
Route::delete('/clients/delete/{Adresse}',[ClientController::class,"delete"]);

// les routes vers les differents elements externe
Route::get('/externe',[externeController::class,"index"]);
Route::post('/externe/create',[externeController::class,"create"]);
Route::put('/externe/editor/{Adresse}',[externeController::class,"editor"]);
Route::delete('/externe/delete/{Adresse}',[ExterneController::class,"delete"]);

// les routes vers les differents elements operation
Route::get('/operation',[operationController::class,"index"]);
Route::post('/operation/create',[operationController::class,"create"]);
Route::put('/operation/editor/{Adresse}',[operationController::class,"editor"]);
Route::delete('/operation/delete/{Adresse}',[OperationController::class,"delete"]);

// les routes vers les differents elements utilisateur
Route::get('/utilisateur',[utilisateurController::class,"index"]);
Route::post('/utilisateur/create',[utilisateurController::class,"create"]);
Route::put('/utilisateur/editor/{Adresse}',[utilisateurController::class,"editor"]);
Route::delete('/utilisateur/delete/{Adresse}',[UtilisateurController::class,"delete"]);

// la route vers la page d'Accueil
Route::view('/', 'welcome');

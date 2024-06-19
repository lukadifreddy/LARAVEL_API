<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AdresseController;

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

Route::get('/adresses',[AdresseController::class,"index"]);
Route::post('/adresses/create',[AdresseController::class,"create"]);
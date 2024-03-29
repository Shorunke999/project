<?php

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

Route::middleware('auth:sanctum')->group(function () { 
    //Route::get('/getQuestion',[\App\Http\Controllers\Controller::class,'question']);
});
Route::post('/register',[\App\Http\Controllers\AuthController::class,'register']);
Route::post('/login',[\App\Http\Controllers\AuthController::class,'login']);
Route::get('/getQuestion',[\App\Http\Controllers\Controller::class,'question']);
    Route::post('/answerCheck',[\App\Http\Controllers\Controller::class,'answerCheck']);
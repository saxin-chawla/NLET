<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CandidateController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware'=>'api' , 'prefix'=>'auth'] , function($router){
    Route::post('/register' , [AuthController::class, 'register']);
    Route::post('/login' , [AuthController::class, 'login']);
    Route::get('/profile' , [AuthController::class, 'profile']);
    Route::get('/logout' , [AuthController::class, 'logout']);
    Route::post('/candidate' , [CandidateController::class, 'candidate']);
    Route::get('/candidates/{id}', [CandidateController::class, 'findCandidateById']);
    Route::get('/candidates', [CandidateController::class, 'listCandidates']);
    Route::get('/candidates/search/{name}', [CandidateController::class, 'searchCandidatesByName']);



});

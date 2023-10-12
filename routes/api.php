<?php

use App\Http\Controllers\QuestionController;
use App\Http\Controllers\RecommendationController;
use Illuminate\Http\Request;
use App\Http\Controllers\QuestionnaireController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('v1')->group(function () {
    Route::get('questionnaire', [QuestionnaireController::class, 'index']);
    Route::post('recommendations', [RecommendationController::class, 'getRecommendations']);

});




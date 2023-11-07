<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// import Controller below
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ReferencePlacesController;
use App\Http\Controllers\EventsController;
use App\Http\Controllers\SquadsController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\CriterionController;
use App\Http\Controllers\CriteriaController;

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

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::get('/user-profile', [AuthController::class, 'userProfile']);
});

Route::controller(ReferencePlacesController::class)->group(function () {
    Route::get('regions', 'showRegions');
    Route::get('province/{id}', 'showProvinces');
    Route::get('citymun/{id}', 'showCityMuns');
    Route::get('barangay/{id}', 'showBarangays');
});

Route::group([
    'middleware' => 'api',
], function ($router) {
    Route::post('/events/{event}/criteria', [EventsController::class, 'addCriteriaToEvent']);
    Route::delete('/events/{event}/criteria/{criteria}', [EventsController::class, 'removeCriteriaToEvent']);
    Route::post('/events/{event}/judges', [EventsController::class, 'addJudgeToEvent']);
    Route::delete('/events/{event}/judges/{judge}', [EventsController::class, 'removeJudgeToEvent']);
    Route::resource('events', EventsController::class, ['only' => ['index', 'show', 'store', 'update']]);

    Route::post('/squads/{squad}/member', [SquadsController::class, 'attachMemberToSquad']);
    Route::delete('/squads/{squad}/member/{member}', [SquadsController::class, 'detachMemberToSquad']);
    Route::resource('squads', SquadsController::class, ['only' => ['index', 'show', 'store', 'update']]);


    Route::resource('members', MemberController::class, ['only' => ['index', 'show', 'store', 'update']]);
    Route::resource('criterions', CriterionController::class, ['only' => ['index', 'show', 'store', 'update']]);
    Route::resource('criterias', CriteriaController::class, ['only' => ['index', 'show', 'store', 'update']]);
});

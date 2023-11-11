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
use App\Http\Controllers\CommunityVotesController;
use App\Http\Controllers\PublicVotesController;
use App\Http\Controllers\DiscordController;
use App\Http\Controllers\EventParticipantsController;
use App\Http\Controllers\WinnersController;

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
    Route::get('/events/{event}/judges', [EventsController::class, 'getEventJudges']);
    Route::post('/events/{event}/judges', [EventsController::class, 'addJudgeToEvent']);
    Route::delete('/events/{event}/judges/{judge}', [EventsController::class, 'removeJudgeToEvent']);
    Route::post('/events/{event}/judges/{judges}/squads/{squads}/scores', [EventsController::class, 'recordEventJudgeSquadScores']);
    Route::get('/events/{event}/judges/{judges}/squads/{squads}/getJudgeScore', [EventsController::class, 'calculateJudgeScore']);
    Route::get('/events/{event}/squads/{squads}/getTotalScoreFromJudges', [EventsController::class, 'getTotalScoreFromJudges']);
    Route::get('/events/{event}/squads/{squads}/getFinalScore', [EventsController::class, 'getFinalScoresFromJudgesAndCommunity']);
    Route::get('/events/{event}/getEventsFinalScore', [EventsController::class, 'getAllFinalScoresFromJudgesAndCommunity']);
    Route::get('/events/{event}/countJudges', [EventsController::class, 'getNumberOfJudges']);
    Route::get('/events/{event}/criteria', [EventsController::class, 'getEventCriteria']);
    Route::post('/events/{event}/force-declare-winner', [EventsController::class, 'forceDeclareWinner']);
    Route::post('/events/{event}/member/{member}/register', [EventParticipantsController::class, 'store']);
    Route::delete('/events/{event}/member/{member}/cancel-registration', [EventParticipantsController::class, 'destroy']);
    Route::resource('events', EventsController::class, ['only' => ['index', 'show', 'store', 'update']]);

    Route::post('/squads/{squad}/member', [SquadsController::class, 'attachMemberToSquad']);
    Route::delete('/squads/{squad}/member/{member}', [SquadsController::class, 'detachMemberToSquad']);
    Route::resource('squads', SquadsController::class, ['only' => ['index', 'show', 'store', 'update']]);

    Route::resource('members', MemberController::class, ['only' => ['index', 'show', 'store', 'update']]);
    Route::resource('criterions', CriterionController::class, ['only' => ['index', 'show', 'store', 'update']]);
    Route::resource('criterias', CriteriaController::class, ['only' => ['index', 'show', 'store', 'update']]);

    Route::post('/community-votes', [CommunityVotesController::class, 'store']);
    Route::get('/community-votes/events/{events}/squads/{squads}', [CommunityVotesController::class, 'getEventSquadCommunityVotes']);

    Route::post('/public-votes', [PublicVotesController::class, 'store']);
    Route::get('/public-votes/events/{events}/squads/{squads}', [PublicVotesController::class, 'getEventSquadPublicVotes']);

    // Route::resource('winners', WinnersController::class, ['only' => ['index', 'show', 'store', 'update']]);

    Route::get('/winners/events/{events}', [WinnersController::class, 'getWinnerByEventId']);

});


Route::group([
    'prefix' => 'discord'
], function ($router) {
    Route::get('/guild-members-list', [DiscordController::class, 'getGuildMembersList']);
    Route::post('/verify-member', [DiscordController::class, 'verifyMember']);
});

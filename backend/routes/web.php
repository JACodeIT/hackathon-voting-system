<?php

use Illuminate\Support\Facades\Route;


use App\Http\Controllers\DiscordController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::redirect('/login', 'https://discord.com/oauth2/authorize?client_id=' . config('discord.client_id')
    . '&redirect_uri=' . config('discord.redirect_uri')
    . '&response_type=code&scope=' . implode('%20', explode('&', config('discord.scopes')))
    . '&prompt=' . config('discord.prompt', 'none'))
    ->name('login');


Route::group(['prefix' => config('discord.route_prefix', 'discordbrowser')], function() {
    Route::get('/callback', [DiscordController::class, 'handle'])
        ->name('discord.login');

    Route::redirect('/refresh-token', url('login'))
        ->name('discord.refresh_token');
});

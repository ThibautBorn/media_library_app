<?php

use Illuminate\Support\Facades\Route;
use MarcReichel\IGDBLaravel\Models\Game;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('welcome');


Route::get('/my_games', 'GameController@index')->name('list_games');
Route::get('/add_game', 'GameController@create')->name('create_game');
Route::post('/add_game', 'GameController@store')->name('store_game');


Route::get('/see_games', function () {
    return view('game.cards');
})->name('see_games');


Route::get('/get_games', 'GameController@get_games')->name('get_games');


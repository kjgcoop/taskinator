<?php

use Illuminate\Http\Request;
use App\TaskinatorBoardApi;

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

// https://www.tutsmake.com/create-rest-api-using-passport-laravel-5-8-authentication/
// https://artisansweb.net/how-to-use-laravel-passport-for-rest-api-authentication/
Route::prefix('v1')->group(function(){

    Route::match(['get', 'post'], '/login', 'ApiAuthController@login');
    Route::match(['get', 'post'], '/register', 'ApiAuthController@register');

    // Boards
    Route::middleware('auth:api')->match(['get', 'post'], '/show-boards',  'TaskinatorBoardApi@showAll');

    Route::middleware('auth:api')->match(['get', 'post'], '/create-board',  'TaskinatorBoardApi@create');   // C
//    Route::middleware('auth:api')->match(['get', 'post'], '/show-board',  'TaskinatorBoardApi@show');     // R - requires lists, tasks and tags.
    Route::middleware('auth:api')->match(['get', 'post'], '/edit-board',  'TaskinatorBoardApi@edit');       // U
    Route::middleware('auth:api')->match(['get', 'post'], '/archive-board',  'TaskinatorBoardApi@archive'); // D
    Route::middleware('auth:api')->match(['get', 'post'], '/unarchive-board',  'TaskinatorBoardApi@unarchive');

    // Lists
    Route::middleware('auth:api')->match(['get', 'post'], '/show-lists',  'TaskinatorListApi@showAll');

    Route::middleware('auth:api')->match(['get', 'post'], '/create-list',  'TaskinatorListApi@create');     // C
    Route::middleware('auth:api')->match(['get', 'post'], '/show-list',  'TaskinatorListApi@show');         // R - requires tasks and tags
    Route::middleware('auth:api')->match(['get', 'post'], '/show-list',  'TaskinatorListApi@create');       // U
    Route::middleware('auth:api')->match(['get', 'post'], '/archive-list',  'TaskinatorListApi@archive');   // D
    Route::middleware('auth:api')->match(['get', 'post'], '/unarchive-list',  'TaskinatorListApi@unarchive');

});


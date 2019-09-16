<?php

use Illuminate\Http\Request;
use App\TaskinatorApi;

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

    Route::middleware('auth:api')->get('/show-boards', 'TaskinatorApi@showBoards')->name('showBoards');
//    Route::match([ 'get', 'post' ], 'show-boards',  'TaskinatorApi@showBoards');




//    Route::group(['middleware' => 'auth:api'], function(){
//        Route::match(['get','post'], 'show-boards', 'TaskinatorApi@showBoards');
//    });
});


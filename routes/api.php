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
    Route::middleware('auth:api')->match(['get', 'post'], '/show-board',  'TaskinatorBoardApi@show');       // R - requires lists, tasks and tags.
    Route::middleware('auth:api')->match(['get', 'post'], '/edit-board',  'TaskinatorBoardApi@edit');       // U
    Route::middleware('auth:api')->match(['get', 'post'], '/archive-board',  'TaskinatorBoardApi@archive'); // D
    Route::middleware('auth:api')->match(['get', 'post'], '/unarchive-board',  'TaskinatorBoardApi@unarchive');

    // Lists
    Route::middleware('auth:api')->match(['get', 'post'], '/show-lists',  'TaskinatorListApi@showAll');

    Route::middleware('auth:api')->match(['get', 'post'], '/create-list',  'TaskinatorListApi@create');     // C
    Route::middleware('auth:api')->match(['get', 'post'], '/show-list',  'TaskinatorListApi@show');         // R - requires tasks and tags
    Route::middleware('auth:api')->match(['get', 'post'], '/edit-list',  'TaskinatorListApi@edit');         // U
    Route::middleware('auth:api')->match(['get', 'post'], '/archive-list',  'TaskinatorListApi@archive');   // D
    Route::middleware('auth:api')->match(['get', 'post'], '/unarchive-list',  'TaskinatorListApi@unarchive');

    // Tasks
    Route::middleware('auth:api')->match(['get', 'post'], '/show-tasks',  'TaskinatorTaskApi@showAll');

    Route::middleware('auth:api')->match(['get', 'post'], '/create-task',  'TaskinatorTaskApi@create');     // C
    Route::middleware('auth:api')->match(['get', 'post'], '/show-task',  'TaskinatorTaskApi@show');         // R - requires tags
    Route::middleware('auth:api')->match(['get', 'post'], '/edit-task',  'TaskinatorTaskApi@edit');         // U
    Route::middleware('auth:api')->match(['get', 'post'], '/archive-task',  'TaskinatorTaskApi@archive');   // D
    Route::middleware('auth:api')->match(['get', 'post'], '/unarchive-task',  'TaskinatorTaskApi@unarchive');

    Route::middleware('auth:api')->match(['get', 'post'], '/show-unaffiliated-tasks',  'TaskinatorTaskApi@showAllUnaffiliated');

    // Tags
    Route::middleware('auth:api')->match(['get', 'post'], '/show-tags',  'TaskinatorTagApi@showAll');

    Route::middleware('auth:api')->match(['get', 'post'], '/create-tag',  'TaskinatorTagApi@create');        // C
    Route::middleware('auth:api')->match(['get', 'post'], '/show-tag',  'TaskinatorTagApi@show');            // R
    Route::middleware('auth:api')->match(['get', 'post'], '/edit-tag',  'TaskinatorTagApi@edit');            // U
    Route::middleware('auth:api')->match(['get', 'post'], '/archive-tag',  'TaskinatorTagApi@archive');      // D
    Route::middleware('auth:api')->match(['get', 'post'], '/unarchive-tag',  'TaskinatorTagApi@unarchive');


    // Task-tag relationships - note these are in the task controller, not the tag
    Route::middleware('auth:api')->match(['get', 'post'], '/assign-tag-task',  'TaskinatorTaskApi@assignTag');
    Route::middleware('auth:api')->match(['get', 'post'], '/unassign-tag-task',  'TaskinatorTaskApi@unassignTag');

    // Show all the tasks in a tag
    Route::middleware('auth:api')->match(['get', 'post'], '/show-tag-tasks',  'TaskinatorTagApi@showTasks');
});

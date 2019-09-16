<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Board;

class TaskinatorApi extends Controller
{

    // https://medium.com/@PhillyWebGuy/using-laravel-passport-to-authenticate-access-to-your-api-4412a764e57a
/*    public function __construct()
    {
        $this->middleware('client');
    }
*/

    public function showBoards()
    {
        $this->errorMessage = [ 'Unable to list boards' ];

        try {
            $boards = Board::all();
        } catch (Exception $e) {
            $boards = false;
        }


        if ($boards){
            return response()->json(new TaskinatorApiResult($boards, false));
        } else {
            return response()->json(['error' => 'Unauthorised'], 401);
            return response()->json(new TaskinatorApiResult(false, $this->errorMessage));
        }
    }


}

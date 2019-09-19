<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Board;

class TaskinatorBoardApi extends Controller
{

    public function archive(Request $request)
    {
        $board = Board::find($request->id);

        $this->errorMessage = [ 'Unable to archive board '.$board->name.'.' ];

        if ($board->archive())
        {
            return response()->json(new TaskinatorApiResult(true, false));
        } else {
            return response()->json(new TaskinatorApiResult(false, $this->errorMessage));
        }
    }

    public function create(Request $request)
    {
        $this->errorMessage = [ 'Unable to create board '.$request->input('name').'.' ];

        $name = $request->name;
        $newBoard = new Board();

        if ($newBoard->saveBoard($name))
        {
            return response()->json(new TaskinatorApiResult(true, false));
        } else {
            return response()->json(new TaskinatorApiResult(false, $this->errorMessage));
        }
    }

    public function edit(Request $request)
    {
        $board = Board::find($request->id);
        $oldName = $board->name;
        $board->name = $request->name;

        $this->errorMessage = [ 'Unable to edit board '.$oldName.'.' ];

        if ($board->save())
        {
            return response()->json(new TaskinatorApiResult(true, false));
        } else {
            return response()->json(new TaskinatorApiResult(false, $this->errorMessage));
        }
    }

    public function showAll()
    {
        $this->errorMessage = [ 'Unable to list boards.' ];

        try
        {
            $boards = Board::all();
        } catch (Exception $e) {
            $boards = false;
        }

        if ($boards)
        {
            return response()->json(new TaskinatorApiResult($boards, false));
        } else {
            return response()->json(new TaskinatorApiResult(false, $this->errorMessage));
        }
    }


    public function unarchive(Request $request)
    {
        $board = Board::find($request->id);

        $this->errorMessage = [ 'Unable to restore board '.$board->name.'.' ];

        if ($board->unarchive())
        {
            return response()->json(new TaskinatorApiResult(true, false));
        } else {
            return response()->json(new TaskinatorApiResult(false, $this->errorMessage));
        }
    }
}

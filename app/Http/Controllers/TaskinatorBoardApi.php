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

        $this->errorMessage = [ 'Unable to edit board '.$oldName.'.' ];

        if ($board->edit($request->name))
        {
            return response()->json(new TaskinatorApiResult(true, false));
        } else {
            return response()->json(new TaskinatorApiResult(false, $this->errorMessage));
        }
    }

    public function show(Request $request)
    {
        $board = Board::find($request->id);

        $this->errorMessage = [ 'Unable to show board '.$board->name.'.' ];

        if ($board->show())
        {
            return response()->json(new TaskinatorApiResult($board->show(), false));
        } else {
            return response()->json(new TaskinatorApiResult(false, $this->errorMessage));
        }
    }


    public function showAll()
    {
        $this->errorMessage = [ 'Unable to list boards.' ];

        try
        {
            // Get all the values
            $boards = Board::orderBy('name')->get();

            // Smash down to id => name
            $boards = $boards->mapWithKeys(function ($item) {
                return [$item['id'] => $item['name']];
            });

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

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TList;

class TaskinatorListApi extends Controller
{

    public function archive(Request $request)
    {
        $list = TList::find($request->id);

        $this->errorMessage = [ 'Unable to archive list '.$list->name.'.' ];

        if ($list->archive())
        {
            return response()->json(new TaskinatorApiResult(true, false));
        } else {
            return response()->json(new TaskinatorApiResult(false, $this->errorMessage));
        }
    }

    public function create(Request $request)
    {
        $this->errorMessage = [ 'Unable to create list '.$request->input('name').'.' ];

        $name = $request->name;
        $board_id = $request->board_id;
        $sort = $request->sort;
        $newList = new TList();

        try {
            if ($newList->saveTList($name, $board_id, $sort))
            {
                return response()->json(new TaskinatorApiResult(true, false));
            } else {
                return response()->json(new TaskinatorApiResult(false, $this->errorMessage));
            }
        } catch (Exception $e) {
            return response()->json(new TaskinatorApiResult(false, $this->errorMessage));
        }
    }

    public function edit(Request $request)
    {
        echo "Will edit list.\n";

        $list = TList::find($request->id);
        $oldName = $list->name;
        $list->name = $request->name;

        $this->errorMessage = [ 'Unable to edit list '.$oldName.'.' ];

        if ($list->save())
        {
            return response()->json(new TaskinatorApiResult(true, false));
        } else {
            return response()->json(new TaskinatorApiResult(false, $this->errorMessage));
        }
    }

    public function showAll()
    {
        $this->errorMessage = [ 'Unable to list lists.' ];

        try
        {
            $lists = TList::all();
        } catch (Exception $e) {
            $lists = false;
        }

        if ($lists)
        {
            return response()->json(new TaskinatorApiResult($lists, false));
        } else {
            return response()->json(new TaskinatorApiResult(false, $this->errorMessage));
        }
    }


    public function unarchive(Request $request)
    {
        echo "Will unarchive list.\n";

        $list = TList::find($request->id);

        $this->errorMessage = [ 'Unable to restore list '.$list->name.'.' ];

        if ($list->unarchive())
        {
            return response()->json(new TaskinatorApiResult(true, false));
        } else {
            return response()->json(new TaskinatorApiResult(false, $this->errorMessage));
        }
    }
}

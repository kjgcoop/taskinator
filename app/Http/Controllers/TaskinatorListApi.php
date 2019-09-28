<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TList;
use App\Board;

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
        $list = TList::find($request->id);
        $oldName = $list->name;

        $newValues = [];

        // They may have sent some or none of the following values:
        $options = ['name', 'board_id', 'sort'];

        foreach ($options as $option) {
            if (isset($data[$option])) {
                $newValues[$option] = $data[$option];
            }
        }

        $this->errorMessage = [ 'Unable to edit list '.$oldName.'.' ];

        if (count($newValues) === 0 || $list->edit($newValues))
        {
            return response()->json(new TaskinatorApiResult(true, false));
        } else {
            return response()->json(new TaskinatorApiResult(false, $this->errorMessage));
        }
    }

    public function show(Request $request)
    {
        $this->errorMessage = [ 'Unable to show list.' ];

        try
        {
            $list = TList::find($request->list_id);

        } catch (Exception $e) {
            $list = false;
        }

        if ($list)
        {
            return response()->json(new TaskinatorApiResult($list, false));
        } else {
            return response()->json(new TaskinatorApiResult(false, $this->errorMessage));
        }
    }

    public function showAll(Request $request)
    {
        $this->errorMessage = [ 'Unable to list lists.' ];

        try
        {
            $lists = Board::find($request->board_id)->tlists;

            $lists = $lists->mapWithKeys(function ($item) {
                return [$item['id'] => $item];
            });

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

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TList;
use App\Task;
use App\Tag;

class TaskinatorTaskApi extends Controller
{

    public function archive(Request $request)
    {
        $task = Task::find($request->id);

        $this->errorMessage = [ 'Unable to archive task '.$task->name.'.' ];

        if ($task->archive())
        {
            return response()->json(new TaskinatorApiResult(true, false));
        } else {
            return response()->json(new TaskinatorApiResult(false, $this->errorMessage));
        }
    }

    public function assignTag(Request $request)
    {
        $task = Task::find($request->task_id);
        $tag = Tag::find($request->tag_id);

        $this->errorMessage = [ 'Unable to assign tag '.$tag->name.' to task '.$task->name.'.' ];

        if ($task->assignTag($request->tag_id))
        {
            return response()->json(new TaskinatorApiResult(true, false));
        } else {
            return response()->json(new TaskinatorApiResult(false, $this->errorMessage));
        }
    }



    public function create(Request $request)
    {
        $this->errorMessage = [ 'Unable to create task '.$request->input('name').'.' ];

        $data['name'] = $request->name;
        $data['sort'] = $request->sort;

        if (isset($request->t_list_id)) {
            $data['t_list_id'] = $request->t_list_id;
        }

        $task = new Task();

        try {
            if ($task->saveTask($data))
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
        $task = Task::find($request->id);
        $oldName = $task->name;

        $newValues = [];

        // They may have sent some or none of the following values:
        $options = ['name', 't_list_id', 'sort'];

        foreach ($options as $option) {
            if (isset($data[$option])) {
                $newValues[$option] = $data[$option];
            }
        }

        $this->errorMessage = [ 'Unable to edit task '.$oldName.'.' ];

        if (count($newValues) === 0 || $task->edit($newValues))
        {
            return response()->json(new TaskinatorApiResult(true, false));
        } else {
            return response()->json(new TaskinatorApiResult(false, $this->errorMessage));
        }
    }

    public function show(Request $request)
    {


        $this->errorMessage = [ 'Unable to list tasks.' ];

        try
        {
            $task = Task::find($request->id);

            // Improve the error message
            $this->errorMessage = [ 'Unable to show task '.$task->name.'.' ];

        } catch (Exception $e) {
            $task = false;
        }

        if ($task->show())
        {
            return response()->json(new TaskinatorApiResult($task, false));
        } else {
            return response()->json(new TaskinatorApiResult(false, $this->errorMessage));
        }
    }



    public function showAll(Request $request)
    {
        $this->errorMessage = [ 'Unable to list tasks.' ];

        try
        {
            $tasks = TList::find($request->t_list_id)->tasks;

            $tasks = $tasks->mapWithKeys(function ($item) {
                return [$item['id'] => $item];
            });

        } catch (Exception $e) {
            $tasks = false;
        }

        if ($tasks)
        {
            return response()->json(new TaskinatorApiResult($tasks, false));
        } else {
            return response()->json(new TaskinatorApiResult(false, $this->errorMessage));
        }
    }


    public function showAllUnaffiliated(Request $request)
    {
        $this->errorMessage = [ 'Unable to list unaffiliated tasks.' ];

        try
        {
            $tasks = Task::where('t_list_id', 0)->get();

            $tasks = $tasks->mapWithKeys(function ($item) {
                return [$item['id'] => $item];
            });

        } catch (Exception $e) {
            $tasks = false;
        }

        if ($tasks)
        {
            return response()->json(new TaskinatorApiResult($tasks, false));
        } else {
            return response()->json(new TaskinatorApiResult(false, $this->errorMessage));
        }
    }



    public function unarchive(Request $request)
    {
        $task = Task::find($request->id);

        $this->errorMessage = [ 'Unable to restore task '.$task->name.'.' ];

        if ($task->unarchive())
        {
            return response()->json(new TaskinatorApiResult(true, false));
        } else {
            return response()->json(new TaskinatorApiResult(false, $this->errorMessage));
        }
    }

    public function unassignTag(Request $request)
    {
        $task = Task::find($request->task_id);
        $tag = Tag::find($request->tag_id);

        $this->errorMessage = [ 'Unable to unassign tag '.$tag->name.' to task '.$task->name.'.' ];

        if ($task->unassignTag($request->tag_id))
        {
            return response()->json(new TaskinatorApiResult(true, false));
        } else {
            return response()->json(new TaskinatorApiResult(false, $this->errorMessage));
        }
    }

}

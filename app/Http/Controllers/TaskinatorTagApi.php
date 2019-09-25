<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tag;

class TaskinatorTagApi extends Controller
{

    public function archive(Request $request)
    {
        $tag = Tag::find($request->id);

        $this->errorMessage = [ 'Unable to archive tag '.$tag->name.'.' ];

        if ($tag->archive())
        {
            return response()->json(new TaskinatorApiResult(true, false));
        } else {
            return response()->json(new TaskinatorApiResult(false, $this->errorMessage));
        }
    }

    public function create(Request $request)
    {
        $this->errorMessage = [ 'Unable to create tag '.$request->input('name').'.' ];

        $data['name'] = $request->name;
        $data['color_id'] = $request->color_id;

        $tag = new Tag();

        try {
            if ($tag->saveTag($data))
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
        $tag = Tag::find($request->id);
        $oldName = $tag->name;

        $data['name'] = $request->name;
        $data['color_id'] = $request->color_id;

        $this->errorMessage = [ 'Unable to edit tag '.$oldName.'.' ];

        if ($tag->edit($data))
        {
            return response()->json(new TaskinatorApiResult(true, false));
        } else {
            return response()->json(new TaskinatorApiResult(false, $this->errorMessage));
        }
    }

    public function show(Request $request)
    {
        $this->errorMessage = [ 'Unable to list tags.' ];

        try
        {
            $tag = Tag::find($request->id);
        } catch (Exception $e) {
            $tags = false;
        }

        if ($data = $tag->show())
        {
            return response()->json(new TaskinatorApiResult($data, false));
        } else {
            return response()->json(new TaskinatorApiResult(false, $this->errorMessage));
        }
    }

    public function showAll(Request $request)
    {
        $this->errorMessage = [ 'Unable to list tags.' ];

        try
        {
            $tags = Tag::all();

            $tags = $tags->mapWithKeys(function ($item) {
                return [$item['id'] => $item];
            });

        } catch (Exception $e) {
            $tags = false;
        }

        if ($tags)
        {
            return response()->json(new TaskinatorApiResult($tags, false));
        } else {
            return response()->json(new TaskinatorApiResult(false, $this->errorMessage));
        }
    }


    // Show all the taks in this tag
    public function showTasks(Request $request)
    {
        try
        {
            $tag = Tag::find($request->id);

            $this->errorMessage = [ 'Unable to list tasks in tag '.$tag->name.'.' ];

        } catch (Exception $e) {
            $tags = false;
        }


        if ($tasks = $tag->showTasks())
        {
            return response()->json(new TaskinatorApiResult($tasks, false));
        } else {
            return response()->json(new TaskinatorApiResult(false, $this->errorMessage));
        }

    }




    public function unarchive(Request $request)
    {
        $tag = Tag::find($request->id);

        $this->errorMessage = [ 'Unable to restore tag '.$tag->name.'.' ];

        if ($tag->unarchive())
        {
            return response()->json(new TaskinatorApiResult(true, false));
        } else {
            return response()->json(new TaskinatorApiResult(false, $this->errorMessage));
        }
    }
}

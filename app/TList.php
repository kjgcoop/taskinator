<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TList extends Model
{
    public function archive() {
        $this->archived = 1;
        return $this->save();
    }

    public function board() {
        return $this->hasOne('App\Board');
    }

    public function edit($data) {
        $options = ['name', 'board_id', 'sort'];

        foreach ($options as $option) {
            if (isset($data[$option])) {
                $this->$option = $data[$option];
            }
        }

        return $this->save();
    }

    public function saveTList($name, $board_id, $sort) {
        $this->name = $name;
        $this->board_id = $board_id;
        $this->sort = $sort;
        return $this->save();
    }

    public function show() {
        $this->load(['tasks' => function ($query) {
//            $query->orderBy('published_date', 'asc');
        }]);
        return $this;

    }

    public function tasks() {
        return $this->hasMany('App\Task')->orderBy('sort');
    }

    public function unarchive() {
        $this->archived = 0;
        return $this->save();
    }
}

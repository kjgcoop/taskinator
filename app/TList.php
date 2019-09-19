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
        $this->hasOne('Board');
    }

    public function edit($name) {
        $this->name = $name;
        return $this->save();
    }

    public function saveTList($name, $board_id, $sort) {
        $this->name = $name;
        $this->board_id = $board_id;
        $this->sort = $sort;
        return $this->save();
    }

    public function show() {
        // Requires lists, tasks and tags.
    }

    public function unarchive() {
        $this->archived = 0;
        return $this->save();
    }
}

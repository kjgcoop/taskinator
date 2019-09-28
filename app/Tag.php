<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Task;

class Tag extends Model
{
    public function __construct() {
    }

    public function archive() {
        $this->archived = 1;

        try {
            return $this->save();
        } catch (Exception $e) {
            return false;
        }
    }

    public function edit($data) {
        $this->name = $data['name'];
        $this->color_id = $data['color_id'];

        try {
            return $this->save();
        } catch (Exception $e) {
            return false;
        }
    }

    public function saveTag($data) {
        $this->name = $data['name'];
        $this->color_id = $data['color_id'];

        try {
            return $this->save();
        } catch (Exception $e) {
            return false;
        }
    }

    public function show() {
        return $this;
    }

    public function showTasks() {
        return $this->tasks;
    }

    public function tasks() {
        return $this->belongsToMany('App\Task');
    }

    public function unarchive() {
        $this->archived = 0;

        try {
            return $this->save();
        } catch (Exception $e) {
            return false;
        }
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use app\TList;

class Task extends Model
{
    public function __construct() {
    }

    public function archive() {
        $this->archived = 1;
        return $this->save();
    }

    public function edit($data) {
        $this->name = $data['name'];
        $this->sort = $data['sort'];

        if (isset($data['t_list_id'])) {
            $this->t_list_id = $data['t_list_id'];
        }

        return $this->save();
    }

    public function saveTask($data) {
        $this->name = $data['name'];
        $this->sort = $data['sort'];

        if (isset($data['t_list_id'])) {
            $this->t_list_id = $data['t_list_id'];
        }

        return $this->save();
    }

    public function show() {
        // Requires tags.
    }

    public function t_list() {
        return $this->hasOne('App\TList');
    }

    public function unarchive() {
        $this->archived = 0;
        return $this->save();
    }
}

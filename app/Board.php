<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use app\TList;

class Board extends Model
{
//    protected $with = ['tlists', 'tlists.tasks', 'tasks.tags'];
    protected $with = ['tlists'];


    public function __construct() {
    }

    public function archive() {
        $this->archived = 1;
        return $this->save();
    }

    public function edit($name) {
        $this->name = $name;
        return $this->save();
    }

    public function tlists() {
        return $this->hasMany('App\TList')->orderBy('sort');
    }

    public function saveBoard($name) {
        $this->name = $name;
        return $this->save();
    }

    public function show() {
        // Requires lists, tasks and tags.
        return $this;

    }

    public function unarchive() {
        $this->archived = 0;
        return $this->save();
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Board extends Model
{
    public function __construct() {
    }

    public function archive() {
        $this->archived = 1;
        $this->save();
    }

    public function edit($name) {
        $this->name = $name;
        $this->save();
    }

    public function lists() {
        $this->hasMany('List');
    }

    public function saveBoard($name) {
        $this->name = $name;
        $this->save();
    }

    public function show() {
        // Requires lists, tasks and tags.
    }

    public function unarchive() {
        $this->archived = 0;
        $this->save();
    }


}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use app\TList;
use app\Tag;

class Task extends Model
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

    public function assignTag($tag_id) {
        try {
            return $this->tags()->attach($tag_id);
        } catch (Exception $e) {
            return false;
        }
    }

    public function edit($data) {
        $this->name = $data['name'];
        $this->sort = $data['sort'];

        if (isset($data['t_list_id'])) {
            $this->t_list_id = $data['t_list_id'];
        }

        try {
            return $this->save();
        } catch (Exception $e) {
            return false;
        }
    }

    public function saveTask($data) {
        $this->name = $data['name'];
        $this->sort = $data['sort'];

        if (isset($data['t_list_id'])) {
            $this->t_list_id = $data['t_list_id'];
        }

        try {
            return $this->save();
        } catch (Exception $e) {
            return false;
        }
    }

    public function show() {
        $this->load(['tags' => function ($query) {
//            $query->orderBy('published_date', 'asc');
        }]);
        return $this;
    }

    public function tags() {
        return $this->belongsToMany('App\Tag');
    }

    public function t_list() {
        return $this->hasOne('App\TList');
    }

    public function unarchive() {
        $this->archived = 0;

        try {
            return $this->save();
        } catch (Exception $e) {
            return false;
        }
    }

    public function unassignTag($tag_id) {
        try {
            return $this->tags()->detach($tag_id);
        } catch (Exception $e) {
            return false;
        }
    }

}

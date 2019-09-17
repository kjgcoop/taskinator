<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class List extends Model
{
    //

    public function board() {
        $this->hasOne('Board');
    }
}

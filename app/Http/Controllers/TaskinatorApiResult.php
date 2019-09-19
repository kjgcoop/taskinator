<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TaskinatorApiResult extends Controller
{
    public $data;
    public $errors;

    //
    public  function __construct($data, $errors) {
        $this->data   = $data;
        $this->errors = $errors;
    }
}

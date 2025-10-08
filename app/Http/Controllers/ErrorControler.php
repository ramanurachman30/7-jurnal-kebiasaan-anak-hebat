<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ErrorControler extends Controller
{
    public function error404 () {
        return abort(404);
    }

    public function error500 () {
        return abort(500);
    }

    public function error401 () {
        return abort(401);
    }

    public function error403 () {
        return abort(403);
    }
}

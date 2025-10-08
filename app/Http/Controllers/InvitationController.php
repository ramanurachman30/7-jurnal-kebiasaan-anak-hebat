<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InvitationController extends AppController
{
    public function create()
    {
        return view('backend.invitation.create');
    }
}

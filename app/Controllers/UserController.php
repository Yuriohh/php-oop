<?php

namespace App\Controllers;

class UserController extends Controller
{
    public function edit()
    {
        return $this->view('user', ['name' => 'Yuriohh']);
    }
}

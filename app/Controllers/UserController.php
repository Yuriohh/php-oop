<?php

namespace App\Controllers;

use App\Core\Request;
use App\Support\Csrf;

class UserController extends Controller
{
    public function edit()
    {
        return $this->view('user', ['name' => 'Yuriohh']);
    }

    public function update(array $params)
    {
        Csrf::validateToken();
        //dd(Request::only(['lastName', 'firstName']));
    }
}

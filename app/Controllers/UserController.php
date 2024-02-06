<?php

namespace App\Controllers;

use App\Database\Models\User;
use App\Support\Validate;

class UserController extends Controller
{
    public function edit()
    {
        return $this->view('user', ['name' => 'Yuriohh']);
    }

    public function update(array $params)
    {
        $validate = new Validate();
        $validated = $validate->validate([
            'firstName' => 'required',
            'lastName' => 'required',
            'email' => 'required|email|unique:' . User::class,
            'password' => 'required|maxLen:10'
        ]);

        if (!$validated) {
            return redirect('/user/1');
        }

    }
}

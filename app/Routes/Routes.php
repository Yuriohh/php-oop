<?php

namespace App\Routes;

class Routes
{
    public static function get()
    {
        return [
            'get' => [
                '/' => 'HomeController@index',
                '/user/[0-9]+' => 'UserController@index',
                '/register' => 'RegisterController@index'
            ],
            'post' => [],
        ];
    }
}

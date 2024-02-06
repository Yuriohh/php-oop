<?php

namespace App\Routes;

class Routes
{
    public static function get()
    {
        return [
            'get' => [
                '/' => 'HomeController@index',
                '/user/[0-9]+' => 'UserController@edit',
                '/register' => 'RegisterController@index',
                '/product/[a-z]+/category/[a-z]+' => 'ProductController@show',
                '/contact' => 'ContactController@index',
            ],
            'post' => [
                '/user/update/[0-9]+' => 'UserController@update',
                '/contact' => 'ContactController@send',
            ],
        ];
    }
}

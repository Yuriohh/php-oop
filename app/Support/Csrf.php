<?php

namespace App\Support;

use App\Core\Request;

class Csrf
{
    public static function getToken()
    {
        if (isset($_SESSION['token'])) {
            unset($_SESSION['token']);
        }

        $_SESSION['token'] = md5(uniqid());

        return "<input type='hidden' name='token' value='{$_SESSION['token']}'>";
    }

    public static function validateToken()
    {
        if (!isset($_SESSION['token'])) {
            throw new \Exception('Token Inválido');
        }

        $token = Request::only('token');

        if ($token['token'] !== $_SESSION['token']) {
            throw new \Exception('Token Inválido');
        }

        unset($_SESSION['token']);
    }
}
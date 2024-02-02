<?php

namespace App\Support;

class Flash
{
    public static function set(string $key, string $value)
    {
        if (!isset($_SESSION[$key])) {
            $_SESSION[$key] = $value;
        }
    }

    public static function get(string $key)
    {
        if (isset($_SESSION[$key])) {
            $message = $_SESSION[$key];
            unset($_SESSION[$key]);

            return $message;
        }
    }
}
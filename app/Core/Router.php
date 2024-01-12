<?php

namespace App\Core;

use Throwable;

class Router
{
    public static function run()
    {
        try {

            $routerRegistered = new RoutersFilter();
            $router = $routerRegistered->get();

            $controller = new Controller();
            $controller->execute($router);

        } catch(Throwable $e) {
            echo $e->getMessage();
        }
    }
}

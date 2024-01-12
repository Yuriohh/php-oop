<?php

namespace App\Core;

use Exception;

class Controller
{
    public function execute(string $route)
    {
        if(! str_contains($route, '@')) {
            throw new Exception('Rota com formato errado');
        }

        list($controller, $method) = explode('@', $route);

        $namespace = 'App\Controllers\\';

        $namespaceController = $namespace . $controller;
    
        if(! class_exists($namespaceController)) {
            throw new Exception("O controller {$namespaceController} não existe");
        }

        $controller = new $namespaceController();

        if(! method_exists($controller, $method)) {
            throw new Exception("O método {$method} não existe no {$namespaceController}");
        }

        $controller->$method();
    }
}

<?php

namespace App\Controllers;

use Exception;
use League\Plates\Engine;

abstract class Controller
{
    private const VIEW_PATH = '../app/Views/';

    protected function view(string $view, array $data = [])
    {
        $fullViewPath = self::VIEW_PATH . $view . '.php';

        if(! file_exists($fullViewPath)) {
            throw new Exception("A view {$view} não existe");
        }

        $templates = new Engine('../app/Views');

        echo $templates->render($view, $data);
    }
}

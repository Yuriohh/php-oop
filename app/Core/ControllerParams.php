<?php

namespace App\Core;

use App\Routes\Routes;
use App\Support\RequestType;
use App\Support\Uri;

class ControllerParams
{
    public function get($router)
    {
        $routes = Routes::get();
        $requestMethod = RequestType::get();

        $router = array_search($router, $routes[$requestMethod]);

        return $this->filterParams($router);
    }

    private function filterParams($router)
    {
        $uri = Uri::get();
        $explodeUri = explode('/', $uri);
        $explodeRouter = explode('/', $router);

        $params = [];

        foreach($explodeRouter as $index => $routerSegment) {
            if($routerSegment !== $explodeUri[$index]) {
                $params[$index] = $explodeUri[$index];        
            }
        }

        return array_values($params);
    }
}

<?php

namespace App\Core;

use App\Routes\Routes;
use App\Support\RequestType;
use App\Support\Uri;

class RoutersFilter
{
    private string $uri;
    private string $method;
    private array $routesRegistered;

    public function __construct()
    {
        $this->uri = Uri::get();
        $this->method = RequestType::get();
        $this->routesRegistered = Routes::get();
    }

    private function simpleRouter()
    {
        if(array_key_exists($this->uri, $this->routesRegistered[$this->method])) {
            return $this->routesRegistered[$this->method][$this->uri];
        }

        return null;
    }

    private function dynamicRouter()
    {
        $routeRegisteredFound = null;

        foreach($this->routesRegistered[$this->method] as $index => $route) {
            $regex = str_replace('/', '\/', ltrim($index, '/'));

            if($index !== '/' && preg_match("/^$regex$/", ltrim($this->uri, '/'))) {
                $routeRegisteredFound = $route;
                break;
            }
        }

        return $routeRegisteredFound;
    }

    public function get()
    {
        if($this->simpleRouter()) {
            return $this->simpleRouter();
        }

        if($this->dynamicRouter()) {
            return $this->dynamicRouter();
        }

        return 'NotFoundController@index';
    }
}

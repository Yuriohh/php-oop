<?php

use App\Core\Router;

require '../vendor/autoload.php';

session_start();

Router::run();

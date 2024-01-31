<?php
use App\Support\Csrf;

function csrf()
{
    return Csrf::getToken();
}
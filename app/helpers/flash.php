<?php
use App\Support\Flash;

function flash(string $key, string $css = '')
{
    $message = Flash::get($key);

    return "<span class='{$css}'>{$message}</span>";
}
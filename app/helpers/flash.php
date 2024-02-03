<?php
use App\Support\Flash;

function flash(string $key, string $css = '')
{
    $message = Flash::get($key);

    return "<span style='{$css}'>{$message}</span>";
}

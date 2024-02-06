<?php

namespace App\Traits;

use App\Core\Request;
use App\Support\Flash;

trait Validations
{
    public function required($field)
    {
        $data = Request::input($field);

        if (empty($data)) {
            Flash::set($field, "Este campo é obrigatório");
            return null;
        }

        return strip_tags($data, '<p><b><span><em>');
    }

    public function maxLen($field, $param)
    {
        $data = Request::input($field);

        if (strlen($data) > $param) {
            Flash::set($field, "Este campo pode haver no máximo {$param} caracteres");
            return null;
        }

        return strip_tags($data, '<p><b><span><em>');
    }

    public function email($field)
    {
        $data = Request::input($field);

        if (!filter_input(INPUT_POST, $field, FILTER_VALIDATE_EMAIL)) {
            Flash::set($field, 'Email inválido');
            return null;
        }

        return strip_tags($data, '<p><b><span><em>');
    }

    public function unique($field, $param)
    {
        $data = Request::input($field);
        $model = new $param();

        $registerFound = $model->findBy($field, $data);

        if($registerFound) {
            Flash::set($field, "O {$field} já esta em uso");
            return null;
        }

        return strip_tags($data, '<p><b><span><em>');
    }
}

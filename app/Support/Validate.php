<?php

namespace App\Support;

use App\Traits\Validations;

class Validate
{
    use Validations;
    public function validate(array $fields)
    {
        $fieldsValidated = [];

        foreach ($fields as $field => $validation) {
            if (!str_contains($validation, '|')) {
                $param = '';

                if (substr_count($validation, ':') === 1) {
                    [$validation, $param] = explode(':', $validation);
                }

                if (!method_exists($this, $validation)) {
                    throw new \Exception("O método {$validation} não existe na validação");
                }

                $fieldsValidated[$field] = $this->$validation($field, $param);
            } else {
                $validations = explode('|', $validation);

                foreach ($validations as $validation) {
                    $param = '';

                    if (substr_count($validation, ':') === 1) {
                        [$validation, $param] = explode(':', $validation);
                    }

                    if (!method_exists($this, $validation)) {
                        throw new \Exception("O método {$validation} não existe na validação");
                    }

                    $fieldsValidated[$field] = $this->$validation($field, $param);

                    if (empty($fieldsValidated[$field])) {
                        break;
                    }
                }
            }
        }

        Csrf::validateToken();

        if (in_array(null, $fieldsValidated, true)) {
            return null;
        }

        return $fieldsValidated[$field];
    }
}
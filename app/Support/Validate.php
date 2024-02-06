<?php

namespace App\Support;

use App\Traits\Validations;

class Validate
{
    use Validations;

    private array $fieldsValidated = [];

    private function getParam($validation, $param)
    {
        if (substr_count($validation, ':') === 1) {
            [$validation, $param] = explode(':', $validation);
        }

        return [$validation, $param];
    }

    private function validationExist($validation): void
    {
        if (!method_exists($this, $validation)) {
            throw new \Exception("O método {$validation} não existe na validação");
        }
    }

    private function multipleValidations($validations, $field, $param)
    {
        foreach ($validations as $validation) {
            [$validation, $param] = $this->getParam($validation, $param);

            $this->validationExist($validation);

            $this->fieldsValidated[$field] = $this->$validation($field, $param);

            if ($this->fieldsValidated[$field] === null) {
                break;
            }
        }

    }
    public function validate(array $fields)
    {
        foreach ($fields as $field => $validation) {
            if (!str_contains($validation, '|')) {
                $param = '';

                [$validation, $param] = $this->getParam($validation, $param);

                $this->validationExist($validation);

                $this->fieldsValidated[$field] = $this->$validation($field, $param);
            }

            if (str_contains($validation, '|')) {
                $validations = explode('|', $validation);
                $param = '';

                $this->multipleValidations($validations, $field, $param);
            }

        }

        return $this->returnValidation();
    }

    private function returnValidation()
    {
        Csrf::validateToken();

        if (in_array(null, $this->fieldsValidated, true)) {
            return null;
        }

        return $this->fieldsValidated;
    }
}

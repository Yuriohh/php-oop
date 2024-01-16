<?php

namespace App\Core;

use Exception;

class Request
{
    public static function input(string $name): string|null
    {
        if(isset($_POST[$name])) {
            return $_POST[$name];
        }

        throw new Exception("O campo {$name} não existe");
    }

    public static function all(): array
    {
        return $_POST;
    }

    public static function only(string|array $only): array
    {
        $fieldsPost = self::all();
        $fieldsPostKeys = array_keys($fieldsPost);

        $arr = [];

        foreach($fieldsPostKeys as $key => $value) {
            $onlyField = (is_string($only) ? $only : (isset($only[$key]) ? $only[$key] : null));
            if(isset($fieldsPost[$onlyField])) {
                $arr[$onlyField] = $fieldsPost[$onlyField];
            }
        }

        return $arr;
    }

    public static function excepts(string|array $excepts): array
    {
        $fieldsPost = self::all();

        if(is_string($excepts)) {
            unset($fieldsPost[$excepts]);
        }

        if(is_array($excepts)) {
            foreach($excepts as $key => $value) {
                unset($fieldsPost[$value]);
            }
        }

        return $fieldsPost;
    }

    public static function query(string $name): string
    {
        if(! isset($_GET[$name])) {
            throw new Exception("A query string {$name} não existe");
        }

        return $_GET[$name];
    }

    public static function toJson(array $data)
    {
        return json_encode($data);
    }

    public static function toArray($data)
    {
        if(isJson($data)) {
            return json_decode($data);
        }
    }
}

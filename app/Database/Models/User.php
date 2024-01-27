<?php

namespace App\Database\Models;

class User extends Model
{
    protected string $table = 'users';

    public function teste()
    {
        dd('teste');
    }
}

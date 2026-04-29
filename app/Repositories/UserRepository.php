<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository
{
    public function findUserById($id)
    {
        return User::find($id);
    }
}

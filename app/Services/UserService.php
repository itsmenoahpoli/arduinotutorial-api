<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Hash;

class UserService extends UserRepository
{
    public function __construct(User $model)
    {
        parent::__construct($model);
    }

    public function create($data)
    {
        $data['password'] = Hash::make($data['password']);
        return parent::create($data);
    }

    public function update($data, $id)
    {
        if (isset($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }
        return parent::update($data, $id);
    }
}
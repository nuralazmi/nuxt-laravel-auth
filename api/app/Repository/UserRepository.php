<?php

namespace App\Repository;

use App\Interface\UserInterface;
use App\Models\User;

class UserRepository implements UserInterface
{

    /**
     * @param User $model
     */
    public function __construct(public User $model)
    {
    }

    /**
     * @param array $data
     * @return User
     */
    #[\Override] public function create(array $data): User
    {
        return $this->model->create($data);
    }
}

<?php

namespace App\Repositories;

use App\DataAccess\Eloquent\User;

class UserRepository implements UserRepositoryInterface
{

    /** @var User */
    protected $eloquent;

    /**
     * @param $user $eloquent
     */
    public function __construct(User $eloquent) {
        $this->eloquent = $eloquent;
    }

    /**
     * @return array
     */
    public function all()
    {
        return $this->eloquent->all();
    }
}

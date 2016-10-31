<?php

namespace App\Services;

//use App\User;
use App\Repositories\UserRepositoryInterface;

class UserService
{
    /** @var UserRepositoryInterface */
    protected $user;

    /**
     * UserService constructor.
     * @param UserRepositoryInterface $user
     */
    public function __construct(UserRepositoryInterface $user)
    {
        $this->user = $user;
    }

    /**
    * @return mixed
    */
   public function getUsers()
   {
       return $this->user->all();
   }
}

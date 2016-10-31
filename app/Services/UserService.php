<?php

namespace App\Services;

use App\User;

class UserService
{
   /**
    * @return mixed
    */
   public function getUsers()
   {
       return User::all();
   }
}

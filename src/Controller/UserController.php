<?php

namespace Controller;

use Entity\User;

class UserController
{
    public function __construct()
    {
      $users = new User();

      $usersList = $users->getBy();
      var_dump($usersList);
    }
}

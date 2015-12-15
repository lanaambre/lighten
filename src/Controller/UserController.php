<?php

namespace src\Controller;

use src\Entity\User;

class UserController
{
    public function __construct()
    {
      $user = new User();
      var_dump($user->exist('username', 'Antoine'));
    }
}

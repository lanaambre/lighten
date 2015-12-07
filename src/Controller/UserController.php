<?php

namespace Controller;

use Model\User;

class UserController
{
    public function __construct()
    {
      $users = new User();
      echo "getAll()\n";
      var_dump($users->test());

      echo "getById(2)\n";
      var_dump($users->getById(2));

      echo "getBy('username', 'Antoine')\n";
      var_dump($users->getBy('username', 'Antoine'));
    }
}

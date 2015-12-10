<?php

namespace Controller;

use Entity\User;

class UserController
{
    public function __construct()
    {
      $users = new User();

      // $usersList = $users->getBy('username', 'Antoine');
      // var_dump($usersList);

      $user = new User();
      $user->setUsername('Junior');
      $user->setPassword('azerty');
      $user->setActive(true);
      $user->persist();
    }
}

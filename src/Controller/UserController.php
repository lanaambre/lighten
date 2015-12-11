<?php

namespace Controller;

use Entity\User;

class UserController
{
    public function __construct()
    {
      // Need to fix fetch/fetchAll [0] problem
      $entity = new User();
      $user = $entity->getBy('username', 'Antoine')[0];
      $user->setActive(true);
      $user->persist();

      $user = new User();
      $user->setUsername('Jean');
      $user->setPassword($this->passwordHash('fkdsjf'));
      $user->setActive(true);
      $user->persist();
    }

    private function passwordHash($password)
    {
      return hash('sha512', $password);
    }


}

<?php

namespace src\Controller;

use src\Entity\User;

class UserController
{
    public function __construct()
    {
      // Need to fix fetch/fetchAll [0] problem
      $entity = new User();
      $user = $entity->custom();
      // $user->setActive(true);
      // $user->persist();

      var_dump($user);

      // $user = new User();
      // $user->setUsername('Jean');
      // $user->setPassword($this->passwordHash('fkdsjf'));
      // $user->setActive(true);
      // $user->persist();
    }

    private function passwordHash($password)
    {
      return hash('sha512', $password);
    }
}

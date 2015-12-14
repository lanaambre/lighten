<?php

namespace src\Controller;

use src\Entity\User;

class UserController
{
    public function __construct()
    {
      // Need to fix fetch/fetchAll [0] problem
      $entity = new User();
      $user = $entity->getMessagesByName('Antoine');


      var_dump($user);
      
    }

    private function passwordHash($password)
    {
      return hash('sha512', $password);
    }
}

<?php

namespace src\Controller;

use src\Entity\User;

class UserController
{
    public function __construct()
    {
      // Need to fix fetch/fetchAll [0] problem
      $entity = new User();
      $user = $entity->getMessagesByName('Antoine')[0];

      var_dump($user->getMessages());
      var_dump($user->getArticles());
    }

    private function passwordHash($password)
    {
      return hash('sha512', $password);
    }
}

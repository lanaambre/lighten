<?php

namespace src\Controller;

use src\Entity\User;

class DefaultController
{
    public function __construct()
    {
      echo "Config OK\n";

      // insert
      // $user = new User;
      // $user->setUsername('Michel');
      // $user->setPassword('chelmi');
      // $user->setActive(true);
      // $user->persist();

      // update
      // $entity = new User;
      // $user = $entity->getBy('username', 'Antoine')[0];
      // $user->setPassword('djskjlkj');
      // $user->persist();

      // messages
      // $entity = new User;
      // $user = $entity->getByWithMessages('username', 'Antoine')[0];
      // var_dump($user->getMessages());

      // exist
      // $user = new User;
      // var_dump($user->exist('username', 'Lana'));

      // count
      // $user = new User;
      // var_dump($user->count());
      // $user = new User;
      // var_dump($user->count('username', 'Antoine'));


      // delete
      // $users = new User;
      // $user = $users->getBy('username', 'Michel')[0];
      // $user->delete();

    }
}

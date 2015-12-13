<?php

namespace src\Entity;
use components\ORM\OrmTable;

class User extends OrmTable
{
  protected $table = 'users';

  protected $id;
  protected $username;
  protected $password;
  protected $active;

  protected $_messages;

  public function getId()
  {
    return $this->id;
  }

  public function setId($id)
  {
    $this->id = $id;
  }

  public function getUsername()
  {
    return $this->username;
  }

  public function setUsername($username)
  {
    $this->username = $username;
  }

  public function getPassword()
  {
    return $this->password;
  }

  public function setPassword($password)
  {
    $this->password = $password;
  }

  public function getActive()
  {
    return $this->active;
  }

  public function setActive($active)
  {
    $this->active = $active;
  }
}

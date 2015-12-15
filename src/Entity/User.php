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

  public $_messages;
  public $_articles;

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

  public function getMessages()
  {
    return $this->_messages;
  }

  public function getArticles()
  {
    return $this->_articles;
  }

  public function getMessagesByName($name)
  {
    $req = $this->query();
    $res = $req->where(['username' => $name])
               ->join('messages')
               ->join('articles')
               ->execute()
               ->fetchAll();
    return $res;



  }
}

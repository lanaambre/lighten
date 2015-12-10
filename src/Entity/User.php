<?php

namespace Entity;

class User extends \LightOrm_Table
{
  protected $table = 'users';

  protected $id;
  protected $username;
  protected $password;
  protected $active;

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

  public function customQueryExample()
  {
    // $req = $this->query();
    // $res = $req->select()
    //            ->execute()
    //            ->fetchAll();
    // return $res;

    $req = $this->query();
    $req->persist();
  }

}

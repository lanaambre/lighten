<?php

namespace Entity;

class User extends \LightOrm_Table
{
  protected $table = 'users';

  protected $data = [
    'id' => null,
    'name' => null,
    'password' => null,
    'active' => null
  ];

  protected $dataJoin;

  public function getId()
  {
    return $this->data['id'];
  }

  public function getName()
  {
    return $this->id;
  }

  public function setName($name)
  {
    $this->data['name'] = $name;
  }

  public function getPassword()
  {
    return $this->id;
  }

  public function setPassword($password)
  {
    $this->data['password'] = $password;
  }

  public function getActive()
  {
    return $this->id;
  }

  public function setActive($active)
  {
    $this->data['active'] = $active;
  }

  public function customQueryExample()
  {
    $req = $this->query();
    $res = $req->select()
               ->execute()
               ->fetchAll();
    return $res;
  }

}

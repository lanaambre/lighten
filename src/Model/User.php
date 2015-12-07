<?php

namespace Model;

class User extends \LightOrm_Table
{
  protected $table = 'users';

  public function test()
  {
    $req = $this->query();
    $res = $req->select()
               ->execute()
               ->fetchAll();
    return $res;
  }
}

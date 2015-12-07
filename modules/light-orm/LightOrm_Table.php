<?php

abstract class LightOrm_Table
{
  private $db;

  public function __construct()
  {
    $this->db = LightOrm_Config::getConnexion();
  }

  public function getAll()
  {
    $req = new LightOrm_QueryBuilder;
    $res = $req->select()
               ->from($this->table)
               ->execute()
               ->fetchAll();
    return $res;
  }

  public function getById($id)
  {
    $req = new LightOrm_QueryBuilder;
    $res = $req->select()
               ->from($this->table)
               ->where([
                 'id' => $id,
               ])
               ->execute()
               ->fetchAll();
    return $res;
  }

  public function getBy($column, $value = null)
  {
    if (is_array($column))
      $where = $column;
    else
      $where = [ $column => $value ];

    $req = new LightOrm_QueryBuilder;
    $res = $req->select()
               ->from($this->table)
               ->where($where)
               ->execute()
               ->fetchAll();
    return $res;
  }
}

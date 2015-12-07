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

  public function getById($id = null)
  {
    if (is_integer($id))
      $where = ['id' =>$id];
    else
      $where = [];

    $req = new LightOrm_QueryBuilder;
    $res = $req->select()
               ->from($this->table)
               ->where($where)
               ->execute()
               ->fetchAll();
    return $res;
  }

  public function getBy($column = null, $value = null)
  {
    if (is_array($column))
      $where = $column;
    else if (is_string($column) && is_string($value))
      $where = [ $column => $value ];
    else
      $where = [];

    $req = new LightOrm_QueryBuilder;
    $res = $req->select()
               ->from($this->table)
               ->where($where)
               ->execute()
               ->fetchAll();
    return $res;
  }
}

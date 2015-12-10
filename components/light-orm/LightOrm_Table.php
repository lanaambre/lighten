<?php

class LightOrm_Table
{
  private $_class;
  private $_update = false;

  public function __construct() {
    $this->_class = get_class($this);
  }

  protected function query()
  {
    $req = new LightOrm_QueryBuilder($this->_class);
    $req->from($this->table);
    return $req;
  }

  public function _toUpdate()
  {
    $this->_update = true;
  }

  public function getAll()
  {
    $req = $this->query();
    $res = $req->select()
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

    $req = $this->query();
    $res = $req->select()
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

    $req = $this->query();
    $res = $req->select()
               ->where($where)
               ->execute()
               ->fetchAll();
    return $res;
  }

  public function persist()
  {
    $req = $this->query();

  }
}

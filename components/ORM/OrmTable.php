<?php


namespace components\ORM;

class OrmTable
{
  private $__class;
  private $__update = false;
  private $__structure;

  public function __construct() {
    $this->__class = get_class($this);
    $this->__structure = get_object_vars($this);
  }

  protected function query()
  {
    $req = new OrmQueryBuilder($this->__class, $this->__structure);
    $req->from($this->table);
    return $req;
  }

  public function _toUpdate()
  {
    $this->__update = true;
  }

  public function persist()
  {
    $data = get_object_vars($this);
    foreach ($data as $key => $value) {
      if ($key[0] === '_')
        unset($data[$key]);
    }
    unset($data['table']);

    $req = $this->query();

    if ($this->__update)
      return $req->update($data);
    else
      return $req->insert($data);
  }

  // Default methods
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

  public function getOneBy($column = null, $value = null)
  {
    if (is_array($column))
      $where = $column;
    else if (is_string($column) && is_string($value))
      $where = [ $column => $value ];
    else
      $where = [];

    // To Do
  }

  public function exist($column = null, $value = null)
  {
    return (bool)$this->getBy($column, $value);
  }

  public function count($column = null, $value = null)
  {
    if (is_array($column))
      $where = $column;
    else if (is_string($column) && is_string($value))
      $where = [ $column => $value ];
    else
      $where = [];

    $req = $this->query();
    $res = $req->count()
               ->where($where)
               ->execute()
               ->fetchAll(false);
    
    return (int)$res[0]['count'];
  }
}

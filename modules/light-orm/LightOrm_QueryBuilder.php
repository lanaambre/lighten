<?php

class LightOrm_QueryBuilder
{
  private $db;

  private $query;

  private $select = '*';
  private $from;
  private $where = [];

  public function __construct()
  {
    $this->db = LightOrm_Config::getConnexion();
  }

  public function select($select = '*')
  {
    $this->select = $select;
    return $this;
  }

  public function from($from)
  {
    $this->from = $from;
    return $this;
  }

  public function where($where)
  {
    if (is_array($where)) {
      foreach ($where as $key => $value) {
        $this->where[$key] = $value;
      }
    }

    return $this;
  }

  public function join()
  {

  }

  public function innerJoin()
  {

  }

  public function joinLeft()
  {

  }

  public function joinRight()
  {

  }

  public function execute()
  {
    $this->query = $this->db->prepare('SELECT ' . $this->select . ' FROM ' . $this->from . $this->whereBuilder());
    $this->query->execute($this->where);

    return $this;
  }

  public function fetchAll()
  {
    $res = $this->query->fetchAll();
    return $res;
  }

  // Builder
  private function whereBuilder()
  {
    $build = '';

    if (!empty($this->where) && is_array($this->where)) {
      $build .= ' WHERE ';
      foreach ($this->where as $key => $value) {
        $build .= $key . ' = :' . $key;
      }
    }

    return $build;
  }
}

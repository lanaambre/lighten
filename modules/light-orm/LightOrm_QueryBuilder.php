<?php

class LightOrm_QueryBuilder
{
  private $db;
  private $class;

  private $query;

  private $select = '*';
  private $from;
  private $where = [];

  public function __construct($class)
  {
    $this->class = $class;
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

  public function fetchAll($objectMode = true)
  {
    $res = $this->query->fetchAll(\PDO::FETCH_ASSOC);

    if ($objectMode)
      return $this->hydration($res);
    return $res;
  }

  private function hydration($raw)
  {
    $res = [];

    foreach ($raw as $key => $data) {
      $entity = new $this->class();

      foreach ($data as $key => $value) {
        $method = 'set' . ucfirst($key);
        $entity->$method($value);
      }
      array_push($res, $entity);
    }

    return $res;
  }

  // Builder
  private function whereBuilder()
  {
    $build = '';

    if (!empty($this->where) && is_array($this->where)) {
      $build .= ' WHERE ';
      $index = 1;
      $count = count($this->where);

      foreach ($this->where as $key => $value) {
        $build .= $key . ' = :' . $key;

        if ($index < $count) {
          $build .= ' AND ';
          $index++;
        }
      }
    }

    return $build;
  }
}

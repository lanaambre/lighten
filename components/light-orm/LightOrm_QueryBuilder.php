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

  // Alias of from function
  public function in($in)
  {
    return $this->from($in);
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

  public function join($join)
  {
    if (is_array($join)) {
      foreach ($join as $key => $value) {
        $this->join[$key] = $value;
      }
    }
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
      $entity->_toUpdate();

      foreach ($data as $key => $value) {
        $method = 'set' . ucfirst($key);
        $entity->$method($value);
      }
      array_push($res, $entity);
    }

    return $res;
  }

  public function update($data)
  {
    // var_dump('update');
    // var_dump($data);
  }

  public function insert($data)
  {
    $data = $this->clearData($data);
    $columns = $this->insertColumnsBuilder($data);
    $values = $this->insertValuesBuilder($data);

    $sql = 'INSERT INTO ' . $this->from . '(' . $columns . ') VALUES (' . $values . ')';

    $this->query = $this->db->prepare($sql);
    $res = $this->query->execute($data);
  }

  public function delete($data)
  {
    // To do
  }

  public function deleteById($id)
  {
    // To do
  }

  public function deleteWhere($data)
  {
    // To do
  }


  /*
    Traitement
  */

  // Remove null columns before insert or update
  private function clearData($data)
  {
    foreach ($data as $key => $value) {
      if (is_null($value))
        unset($data[$key]);
    }
    return $data;
  }

  /*
    Builder
  */
  private function whereBuilder()
  {
    $build = '';

    if (!empty($this->where) && is_array($this->where)) {
      $build .= ' WHERE ';

      foreach ($this->where as $key => $value) {
        $build .= $key . ' = :' . $key . ' AND ';
      }
    }

    return rtrim($build, ' AND ');
  }

  private function joinBuilder()
  {
    $build = '';

    // To Do

    return $build;
  }

  private function insertColumnsBuilder($data)
  {
    $build = '';

    foreach ($data as $column => $value) {
      $build .= $column . ', ';
    }

    return rtrim($build, ', ');
  }

  private function insertValuesBuilder($data)
  {
    $build = '';

    foreach ($data as $column => $value) {
      $build .= ':' . $column . ', ';
    }

    return rtrim($build, ', ');
  }
}

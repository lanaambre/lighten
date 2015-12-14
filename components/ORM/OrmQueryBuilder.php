<?php

namespace components\ORM;

class OrmQueryBuilder
{
  private $db;
  private $class;
  private $structure;

  private $query;

  private $select = '*';
  private $from;
  private $where = [];

  private $selectJoin = '';
  private $join = [];
  private $on = [];
  private $_on = [];

  public function __construct($class = null, $structure = null)
  {
    // Need to secure
    $this->class = $class;
    $this->structure = $structure;

    $this->db = OrmConfig::getConnexion();
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

  public function join($table, $on = 'id', $_on = null)
  {
    if(is_null($_on))
      $_on = rtrim($this->from, 's') . 'Id';

    // Need to secure

    array_push($this->join, $table);
    array_push($this->on, $on);
    array_push($this->_on, $_on);

    return $this;
  }

  public function selectJoin($columns = [])
  {
    if(!empty($this->join)) {
      $this->selectJoin .= ', ';
      foreach ($columns as $value) {
        $this->selectJoin .= $this->join . '.' . $value . ', ';
      }
      $this->selectJoin = rtrim($this->selectJoin, ', ');
    }

    return $this;
  }

  public function execute()
  {
    $this->select = is_array($this->select) ? $this->selectBuilder($this->select) : $this->select;

    $this->query = $this->db->prepare('SELECT ' . $this->select . ' FROM ' . $this->from . $this->whereBuilder());
    $this->query->execute($this->where);

    var_dump($this->query);

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

      // Jointures
      if (!empty($this->join)) {
        $data = [];

        foreach ($this->join as $key => $value) {
          $method = 'get' . ucfirst($this->on[$key]);

          $class = ucfirst(substr($value, -1) == 'ies' ? rtrim($value, 'ies') . 'y' : rtrim($value, 's'));

          $query = new OrmQueryBuilder('src\Entity\\' . $class);
          $query->from($value);
          $query->where([$this->_on[$key] => $entity->$method()]);
          $query->execute();

          $property = '_' . $value;
          $entity->$property = $query->fetchAll();
        }
      }

      array_push($res, $entity);
    }

    return $res;
  }

  public function update($data)
  {
    $data = $this->clearData($data);
    $set = $this->updateSetBuilder($data);

    $where = !empty($data['id']) ? 'id = :id' : $this->whereBuilder($data);
    $whereValues = !empty($data['id']) ? ['id' => $data['id']] : $data;

    $sql = 'UPDATE ' . $this->from . ' SET ' . $set . ' WHERE ' . $where;

    $this->query = $this->db->prepare($sql);
    return $this->query->execute($whereValues);
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
  private function selectBuilder($select)
  {
    $build = '';

    foreach ($select as $column) {
      $build .= $this->from . '.' . $column . ', ';
    }

    return rtrim($build, ', ');
  }

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

  private function updateSetBuilder($data)
  {
    $build = '';

    foreach ($data as $column => $value) {
      if (is_string($value))
        $value = '\'' . $value . '\'';
      $build .= $column . '=' . $value . ', ';
    }

    return rtrim($build, ', ');
  }
}

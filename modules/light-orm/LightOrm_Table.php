<?php

abstract class LightOrm_Table
{
  private $db;

  public function __construct($db_infos)
  {
    $this->db = new \PDO('mysql:host=' . $db_infos['db_host'] . ';dbname=' . $db_infos['db_name'], $db_infos['db_user'], $db_infos['db_password']);
  }

  public function getAll()
  {
    // $query = new LightOrm_QueryBuilder($this->db);
    // $query->select('*')
    //       ->from($this->table)
    //       ->execute();

    $query = $this->db->prepare('SELECT * FROM ' . $this->table);
    $query->execute();

    return $query->fetchAll();
  }

  public function getById($id, $fields = [])
  {
    $query = $this->db->prepare('SELECT * FROM ' . $this->table . ' WHERE id = :id');
    $query->execute([
      'id' => $id,
    ]);
    return $query->fetchAll();
  }

  public function getBy($column, $value)
  {
    $query = $this->db->prepare('SELECT * FROM ' . $this->table . ' WHERE ' . $column . ' = :' . $column);
    $query->execute([
      $column => $value,
    ]);
    return $query->fetchAll();
  }
}

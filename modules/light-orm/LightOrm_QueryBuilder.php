<?php

class LightOrm_QueryBuilder
{
  private $db;

  private $select = '*';
  private $from;
  private $where;

  public function __construct(\PDO $db)
  {
    // Need to secure
    $this->db = $db;
  }


  public function select($select = '*')
  {
    $this->select = $select;
  }

  public function from($from)
  {

  }

  public function join()
  {

  }

  public function joinLeft()
  {

  }

  public function joinRight()
  {

  }
}

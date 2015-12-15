<?php

namespace components\console\generate;

use components\ORM\OrmConfig;

class Entities
{
  private $tables;

  public function __construct()
  {
    $this->tables = $this->getTables();

    var_dump($this->tables);
  }

  private function getTables()
  {
    $db = OrmConfig::getConnexion();

    $query = $db->query('SHOW TABLES FROM orm_test');

    if ($query)
      return $query->fetchAll(\PDO::FETCH_COLUMN);
    else
      exit("Table '" . $this->table . "' doesn't exists\n");
  }
}

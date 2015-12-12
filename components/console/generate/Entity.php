<?php

namespace components\console\generate;

/**
 *
 */
class Entity
{
  private $table;
  private $arguments;

  public function __construct($args)
  {
    $this->arguments = $args;
    var_dump($args);
  }

  private function getStructure()
  {

    // $db = OrmConfig::getConnexion();
    //
    // $query = $db->query('SHOW COLUMNS FROM users');
    // var_dump($query->fetchAll(PDO::FETCH_COLUMN));
  }
}

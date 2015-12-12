<?php

namespace components\console\generate;

use components\ORM\OrmConfig;

class Entity extends Generator
{
  private $table;
  private $structure;

  protected function init()
  {
    if (empty($this->arguments[0]))
      exit("Missing 1 parameters. <name> parameter is require for: generate:entity <name> <table(?)>\n");

    $this->table = empty($this->arguments[1]) ? $this->generateTableName($this->arguments[0]) : $this->arguments[1];

    $this->structure = $this->getStructure();

    var_dump($this->structure);
  }

  private function generateTableName($entity)
  {
    $table = strtolower($entity);

    if (substr($table, -1) == 'y')
      $table = rtrim($table, 'y') . 'ies';
    else
      $table .= 's';

    return $table;
  }

  private function getStructure()
  {
    $db = OrmConfig::getConnexion();

    $query = $db->query('SHOW COLUMNS FROM ' . $this->table);

    if ($query)
      return $query->fetchAll(\PDO::FETCH_COLUMN);
    else
      exit("Table '" . $this->table . "' doesn't exists\n");
  }
}

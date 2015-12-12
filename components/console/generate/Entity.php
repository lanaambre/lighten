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

    $this->table = !empty($this->arguments[1]) ? $this->arguments[1] : $this->generateTableName($this->arguments[0]);
    $this->structure = $this->getStructure();
  }

  private function generateTableName($entity)
  {
    return strtolower(substr($entity, -1) == 'y' ? rtrim($entity, 'y') . 'ies' : $entity . 's');
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

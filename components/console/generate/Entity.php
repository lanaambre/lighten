<?php

namespace components\console\generate;

use components\ORM\OrmConfig;

class Entity extends PhpGenerator
{
  private $name;
  private $table;
  private $structure;

  protected function config()
  {
    if (empty($this->arguments[0]))
      exit("Missing 1 parameters. <name> parameter is require for: generate:entity <name> <table(?)>\n");

    $this->name = $this->arguments[0];
    $this->table = !empty($this->arguments[1]) ? $this->arguments[1] : $this->generateTableName($this->arguments[0]);
    $this->structure = $this->getStructure();

    $this->namespace = 'src\Entity';
    $this->use = [
      'components\ORM\OrmTable',
    ];

    $this->code();
  }

  private function code()
  {
    $this->initCode();
    $this->addNamespace();
    $this->addUse();

    $this->addClass($this->name, 'OrmTable'); // Open Class

    $this->addProperties('table', $this->table, 'protected');

    foreach ($this->structure as $property) {
      $this->addProperties($property, null, 'protected');
    }
    $this->addLineBreak();

    foreach ($this->structure as $method) {
      $this->addMethods('get' . ucfirst($method), null, 'public');
      $this->addCode('return $this->' . $method . ';');
      $this->closeMethods();
      $this->addLineBreak();

      $this->addMethods('set' . ucfirst($method), [$method], 'public');
      $this->addCode('$this->' . $method . ' = $' . $method . ';');
      $this->closeMethods();
      $this->addLineBreak();
    }

    $this->closeClass(); // Close Class

    file_put_contents("test.php", $this->code);
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

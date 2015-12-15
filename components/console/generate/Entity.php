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
    // Add <?php
    $this->initCode();


    // Namespaces and uses
    $this->addNamespace();
    $this->addUse();


    // Create class with extends
    $this->addClass($this->name, 'OrmTable');


    // Add Properties
    $this->addProperties('table', $this->table, 'protected');
    $this->addLineBreak();

    foreach ($this->structure as $property) {
      $this->addProperties($property, null, 'protected');
    }

    $this->addLineBreak();


    // Add Methods
    foreach ($this->structure as $method) {
      // Getters
      $this->addMethods('get' . ucfirst($method), null, 'public');
      $this->addCode('return $this->' . $method . ';');
      $this->closeMethods();
      $this->addLineBreak();

      // Setters
      $this->addMethods('set' . ucfirst($method), [$method], 'public');
      $this->addCode('$this->' . $method . ' = $' . $method . ';');
      $this->closeMethods();
      $this->addLineBreak();
    }

    // Close Class
    $this->closeClass(); // Close Class

    $path = 'src/Entity/' . $this->name . '.php';
    
    if (!file_exists($path)) {
      file_put_contents($path, $this->code);
      echo "File " . $this->name . ".php generated\n";
    } else {
      echo '-------------' . "\n";
      echo '|  Warning  |' . "\n";
      echo '-------------' . "\n";
      echo 'Entity "' . $this->name . '" already exists.' . "\n";
      echo 'Overwrite ' . $this->name . '.php ? (y/n) [n]: ';

      $stdin = fopen('php://stdin', 'r');
      $response = fgetc($stdin); // use fgetc for get only first character
      $response = rtrim($response, "\n");
      if (strtolower($response) === 'y') {
        file_put_contents($path, $this->code);
        echo "File overwriten\n";
      } else {
        echo "File not overwriten\n";
      }
    }
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

<?php

namespace components\console\generate;

use components\console\builder\PhpGenerator;

class Controller extends PhpGenerator
{
  protected function config()
  {
    $this->namespace = 'src\Controller';

    $this->code();
  }

  private function code()
  {
    if (!empty($this->arguments[0]))
      $name = $this->arguments[0];
    else {
      echo "Missing 1 parameters: lighten generate:controller controller_name\n";
      exit;
    }

    $this->initCode();
    $this->addNamespace();

    $this->addClass($this->arguments[0]);

    $this->addMethods('__construct', null, 'public');
    $this->addComments('Construct class');
    $this->closeMethods();

    $this->closeClass();

    $path = 'src/Controller/' . $name . '.php';

    if (!file_exists($path)) {
      file_put_contents($path, $this->code);
      echo "File " . $name . ".php generated\n";
    } else {
      echo '-------------' . "\n";
      echo '|  Warning  |' . "\n";
      echo '-------------' . "\n";
      echo 'File "' . $name . '" already exists.' . "\n";
      echo 'Overwrite ' . $name . '.php ? (y/n) [n]: ';

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
}

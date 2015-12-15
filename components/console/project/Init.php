<?php

namespace components\console\project;

use components\tools\Yaml\Dumper;
use components\tools\Yaml\Yaml;

class Init
{
  private $input = [];

  public function __construct()
  {
    echo "-------------------\n";
    echo "New Lighten project\n";
    echo "-------------------\n";

    echo "Project Name: ";

    $stdin = fopen('php://stdin', 'r');
    $response = fgets($stdin); // use fgetc for get only first character
    $this->input['project'] = rtrim($response, "\n");

    echo "Database host: ";

    $stdin = fopen('php://stdin', 'r');
    $response = fgets($stdin);
    $this->input['database']['db_host'] = rtrim($response, "\n");

    echo "Database Name: ";

    $stdin = fopen('php://stdin', 'r');
    $response = fgets($stdin);
    $this->input['database']['db_name'] = rtrim($response, "\n");

    echo "Database Username: ";

    $stdin = fopen('php://stdin', 'r');
    $response = fgets($stdin);
    $this->input['database']['db_user'] = rtrim($response, "\n");

    echo "Database Password: ";

    $stdin = fopen('php://stdin', 'r');
    $response = fgets($stdin);
    $this->input['database']['db_password'] = rtrim($response, "\n");

    echo "Config ok ?\n";
    var_dump($this->input);

    file_put_contents('test.yml', Yaml::dump($this->input, 2));
  }
}

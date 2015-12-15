<?php

namespace components\console\project;

use components\tools\Yaml\Dumper;
use components\tools\Yaml\Yaml;

class Init
{
  private $input = [];
  private $directoryPath;

  public function __construct()
  {
    $this->directoryPath = getcwd();

    echo "-------------------\n";
    echo "New Lighten project\n";
    echo "-------------------\n";


    // Project
    echo "Project Name [" . $this->getDirectory() . "]: ";

    $stdin = fopen('php://stdin', 'r');
    $response = fgets($stdin); // use fgetc for get only first character
    $response = rtrim($response, "\n");
    $response = empty($response) ? $this->getDirectory() : $response;
    $this->input['project'] = $response;


    // Host
    echo "Database Host [localhost]: ";

    $stdin = fopen('php://stdin', 'r');
    $response = fgets($stdin);
    $response = rtrim($response, "\n");
    $response = empty($response) ? 'localhost' : $response;
    $this->input['database']['db_host'] = $response;


    // Name
    echo "Database Name [" . strtolower($this->getDirectory()) . "]: ";

    $stdin = fopen('php://stdin', 'r');
    $response = fgets($stdin);
    $response = rtrim($response, "\n");
    $response = empty($response) ? strtolower($this->getDirectory()) : $response;
    $this->input['database']['db_name'] = $response;


    // User
    echo "Database Username [root]: ";

    $stdin = fopen('php://stdin', 'r');
    $response = fgets($stdin);
    $response = rtrim($response, "\n");
    $response = empty($response) ? 'root' : $response;
    $this->input['database']['db_user'] = $response;


    // Password
    echo "Database Password [root]: ";

    $stdin = fopen('php://stdin', 'r');
    $response = fgets($stdin);
    $response = rtrim($response, "\n");
    $response = empty($response) ? 'root' : $response;
    $this->input['database']['db_password'] = $response;

    echo "Config ok: config/config.yml has been generated.\n";

    file_put_contents('config/config.yml', Yaml::dump($this->input, 2));
  }

  private function getDirectory()
  {
    $splitted = explode('/', $this->directoryPath);
    return array_pop($splitted);
  }
}

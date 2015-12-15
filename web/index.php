<pre>
<?php

require_once '../components/autoload/autoload.php';

use components\ORM\OrmConfig;
use src\Controller\UserController;
use components\tools\Yaml\Yaml;

$config = Yaml::parse(file_get_contents('../config/config.yml'));
$database = $config['database'];

OrmConfig::init($database);

$home = new UserController;

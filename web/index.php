<pre>
<?php

require_once '../components/autoload/autoload.php';

use components\ORM\OrmConfig;
use src\Controller\UserController;
use components\Yaml\Yaml;

$db_infos = Yaml::parse(file_get_contents('../config/db.yml'));

OrmConfig::init($db_infos);

$home = new UserController;

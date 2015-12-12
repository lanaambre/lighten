<pre>
<?php

require_once '../components/autoload/autoload.php';

use components\ORM\OrmConfig;
use src\Controller\UserController;

$db_infos = json_decode(file_get_contents('../config/db.json'), true);

OrmConfig::init($db_infos);

$home = new UserController;

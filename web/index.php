<pre>
<?php

require_once '../components/autoload/autoload.php';

use components\ORM\Orm_Config;
use src\Controller\UserController;

$db_infos = json_decode(file_get_contents('../config/db.json'), true);

Orm_Config::init($db_infos);

$home = new UserController;

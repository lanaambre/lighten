<pre>
<?php

require_once 'autoload.php';

use Controller\UserController;

$db_infos = json_decode(file_get_contents('config/db.json'), true);

LightOrm_Config::init($db_infos);

$home = new UserController;

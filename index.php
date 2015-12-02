<pre>
<?php

require_once 'autoload.php';

use Controller\UserController;

$db_info = json_decode(file_get_contents('config/db.json'), true);

$home = new UserController($db_info);

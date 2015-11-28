<pre>
<?php

require_once 'autoload.php';

use Controller\HomeController;

$home = new HomeController;
$home->hello('World !');

$db_info = json_decode(file_get_contents('config/db.json'), true);

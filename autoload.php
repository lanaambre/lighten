<?php

spl_autoload_register(function($class) {
  // Fix backslash
  $class = str_replace("\\", "/", $class);

  // Get in src folder by default
  if (file_exists('src/' . $class . '.php')) {
    require_once 'src/' . $class . '.php';
    return;
  }

  // Modules config
  $modules = [
    'LightOrm_' => 'components/light-orm/',
  ];

  // Load modules class
  foreach ($modules as $prefix => $path) {
    if (strpos($class, $prefix, 0) === 0) {
      if (file_exists($path . $class . '.php')) {
        require_once $path . $class . '.php';
        return;
      }
    }
  }
});

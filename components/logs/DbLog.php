<?php

namespace components\logs;

class DbLog
{
  public static function access($sql = 'empty')
  {
    $access = "--------------------\n";
    $access .= date('j/m/Y H:i:s') . ': \'' . $sql . "'\n";

    $path = __DIR__ . "/../../logs/db/access.log";

    file_put_contents($path, $access, FILE_APPEND);
  }

  public static function error($errors, $sql = '')
  {
    $error = "--------------------\n";
    $error .= date('j/m/Y H:i:s') . ': ' . $errors[2] . "\n";

    if (!empty($sql))
      $error .= '-> Query tried: \'' . $sql . "'\n";

    $path = __DIR__ . "/../../logs/db/error.log";

    file_put_contents(__DIR__ . '/../../logs/db/error.log', $error, FILE_APPEND);
  }
}

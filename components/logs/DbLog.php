<?php

namespace components\logs;

class DbLog
{
  public static function access($sql = 'empty')
  {
    $access = "-----------------------\n";
    $access .= date('j/m/Y h:i:s A') . ': \'' . $sql . "'\n";

    file_put_contents(__DIR__ . '/../../logs/db/access.log', $access, FILE_APPEND);
  }

  public static function error($errors, $sql = '')
  {
    $error = "-----------------------\n";
    $error .= date('j/m/Y h:i:s A') . ': ' . $errors[2] . "\n";

    if (!empty($sql))
      $error .= '-> Query tried: \'' . $sql . "'\n";

    file_put_contents(__DIR__ . '/../../logs/db/error.log', $error, FILE_APPEND);
  }
}

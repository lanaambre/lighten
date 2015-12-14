<?php

namespace components\logs;

class DbLog
{
  public static function access($sql)
  {
    var_dump($sql);
  }

  public static function error($error)
  {
    var_dump($error);
  }
}

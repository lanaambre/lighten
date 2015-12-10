<?php

class LightOrm_Config
{
  private static $connexion;

  public static function init($db_infos)
  {
    if (is_array($db_infos)) {
      self::$connexion = new \PDO('mysql:host=' . $db_infos['db_host'] . ';dbname=' . $db_infos['db_name'], $db_infos['db_user'], $db_infos['db_password']);
      self::$connexion->query('SET NAMES utf8;');
      return;
    }

    throw new Exception('Invalid or missing parameters for LightOrm_Config::init()', 1);
  }

  public static function getConnexion()
  {
    return self::$connexion;
  }
}

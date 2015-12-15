<?php

namespace components\tools\security;

class Security
{
  public static function generatePassword()
  {
    //
  }

  public static function generateSalt($saltLength = 24)
  {
    $salt = '';
		$count = 0; $max = $saltLength;
    $alphabet = '{}[]0485fDzE:!bHx';
    $length = strlen($alphabet);

		for (;;) {
			if ($count == $max)
				break;
			$rand = mt_rand(0,$length -1);
			$salt .= $alphabet[$rand];
			$count++;
		}

    return $salt;
  }
}

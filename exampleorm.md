# Méthode 1
<!-- PHP CODE -->
$orm = new Orm('127.0.0.1', 'root', 'password');

$user = new User();
$user->setLogin('Antoine');
$user->setEmail('antoine.demailly@gmx.fr');
$user->setPassword(sha512('toto'));
$orm->persist($user);

$all = $orm->getAll('User');

foreach ($all as $u) {
  $u->setPassword(sha1('xxx'));
  $orm->persist($u);
}
<!-- END PHP CODE -->


# Méthode 2
<!-- PHP CODE -->
Orm::init('127.0.0.1', 'root', 'password');

$user = new User();
$user->setLogin('Antoine');
$user->setEmail('antoine.demailly@gmx.fr');
$user->setPassword(sha512('toto'));
$user->persist();

$all = $user->getAll();

foreach ($all as $u) {
  $u->setPassword(sha1('xxx'));
  $u->persist();
}
<!-- END PHP CODE -->

## Appel static
<!-- PHP CODE -->
class Orm
{
  private static $connexion;

  public static function init($host, $user, $password)
  {
    self::$connexion = <!-- new PDO... -->
    self::$connexion->query("SET NAMES utf8;");
  }

  public static function getConnexion()
  {
    return self::$connexion;
  }
}
<!-- END PHP CODE -->
## Pour y accéder dans un model
Orm::getConnexion()->query('SELECT...');

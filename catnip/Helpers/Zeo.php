<?PHP
/*
This class watches over the users interactions so you'll be able to use its functions like back() etc.

Hallo liebe ZEOler und andere NDler <3
*/
namespace Catnip\Helpers;
class Zeo{
    private static $last_visit;
    private static $user_ip;

    public static function setLastVisit()
    {
        self::$last_visit = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    }

    public static function getLastVisit()
    {
        return self::$last_visit;
    }

    public static function setUserIp()
    {
        self::$user_ip = $_SERVER['REMOTE_ADDR'];
    }

    public static function getUserIp()
    {
        return self::$user_ip;
    }
}
?>
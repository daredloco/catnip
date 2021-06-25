<?PHP
namespace Catnip\Helpers;
class Hasher{
    public static function Hash($plain)
    {
        return password_hash($plain, PASSWORD_DEFAULT);
    }

    public static function Verify($plain, $hashed)
    {
        return password_verify($plain, $hashed);
    }
}
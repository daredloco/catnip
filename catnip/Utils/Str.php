<?PHP
namespace Catnip\Utils;

class Str
{
    public static function StartsWith($needle, $haystack)
    {
      if ($needle != '' && strpos($haystack, $needle) === 0) return true;
      return false;
    }

    public static function EndsWith($needle, $haystack)
    {
      if ((string) $needle === substr($haystack, -strlen($needle))) return true;
      return false;
    }
}
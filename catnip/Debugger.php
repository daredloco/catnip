<?PHP
namespace Catnip;
class Debugger{
    const TYPE_INFO = "info";
    const TYPE_WARNING = "warning";
    const TYPE_EXCEPTION = "exception";

    public static function Log($msg, $type = self::TYPE_INFO)
    {
        $all = fopen(dirname(__DIR__).'/logs/all.txt','a');
        $fromtype = fopen(dirname(__DIR__).'/logs/'.$type.'.txt','a');

        fwrite($all, '['.$type.'] '.$msg."\n");
        fclose($all);

        fwrite($fromtype, '['.$type.'] '.$msg."\n");
        fclose($fromtype);
    }

    public static function Info($msg)
    {
        self::Log($msg, self::TYPE_INFO);
    }

    public static function Warning($msg)
    {
        self::Log($msg, self::TYPE_WARNING);
    }

    public static function Exception($msg)
    {
        self::Log($msg, self::TYPE_EXCEPTION);
    }
}
?>
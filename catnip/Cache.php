<?PHP
namespace Catnip{
    class Cache{
        public static $cachefile;
    
        public static function CacheStart()
        {
            if(!CACHE_ACTIVE)
            {
                return;
            }
    
            $url = $_SERVER["SCRIPT_NAME"];
            $break = Explode('/', $url);
            $file = $break[count($break) - 1];
            self::$cachefile = dirname(__DIR__).'/cache/cached-'.substr_replace($file ,"",-4).'.html';
    
            if (file_exists(self::$cachefile) && time() - CACHE_TIME < filemtime(self::$cachefile)) {
                readfile(self::$cachefile);
                exit;
            }
            ob_start();
        }
    
        public static function CacheEnd()
        {
            if(!CACHE_ACTIVE)
            {
                return;
            }
    
            $cached = fopen(self::$cachefile, 'w');
            fwrite($cached, ob_get_contents());
            fclose($cached);
            ob_end_flush();
        }
    
        public static function HasCache()
        {
            $url = $_SERVER["SCRIPT_NAME"];
            $break = Explode('/', $url);
            $file = $break[count($break) - 1];
            $cfile = dirname(__DIR__).'/cache/cached-'.substr_replace($file ,"",-4).'.html';
            if (file_exists($cfile) && time() - CACHE_TIME < filemtime($cfile)) {
                return TRUE;
            }
            return FALSE;
        }
    }
}
?>
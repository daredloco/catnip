<?PHP
namespace Catnip{
    class View{
        public static function Render($view, $values = [], $cache = true)
        {
            $viewlocation = dirname(__DIR__).'/views/'.$view.'.php';
            if (!is_file($viewlocation)) {
                throw new \RuntimeException('View not found: '.$view.' ('.$viewlocation.')');
            }
            $content = file_get_contents($viewlocation);
            $newcontent = self::Compile($content, $cache);
            
            $rbytes = session_id();
            
            $tmplocation = dirname(__DIR__).'/temp/'.str_replace("/","-",$view).$rbytes.'.php';
            
            file_put_contents($tmplocation, $newcontent);
            ob_start();
                extract($values);
                include($tmplocation);
                unlink($tmplocation);
            echo ob_get_clean();
            
        }
    
        public static function RenderFromFile($viewlocation, $viewname, $values = [], $cache = true)
        {
            if (!is_file($viewlocation)) {
                throw new \RuntimeException('View not found: '.$view.' ('.$viewlocation.')');
            }
            $content = file_get_contents($viewlocation);
            $newcontent = self::Compile($content, $cache);
            
            $rbytes = session_id();
            $viewname = str_replace(["/", "\\"], ["-", "-"], $viewname);
            $viewname .= $rbytes.'.php';
            $tmplocation = dirname(__DIR__).'/Temp/'.$viewname;
    
            file_put_contents($tmplocation, $newcontent);
            ob_start();
                extract($values);
                include($tmplocation);
                unlink($tmplocation);      
            echo ob_get_clean();
        }
    
        private static function Compile($content, $cache)
        {
            //Load Loca
            if(isset($_SESSION['language']))
            {
                $userlanguage = $_SESSION['language'];
            }else{
                $userlanguage = null;
            }
            Loca::Load($userlanguage);

            //Start Cachefunction
            if($cache)
            {
                $content = "<?PHP \\Catnip\\Cache::CacheStart(); ?>".$content;
            }

            //Handle @if, @elseif, @else and @endif
            $newcontent = preg_replace("/@if\((.*)\)/", "<?PHP if($1){ ?>", $content);
            $newcontent = preg_replace("/@elseif\((.*)\)/", "<?PHP }elseif($1){ ?>", $newcontent);
            $newcontent = preg_replace("/@else/", "<?PHP }else{ ?>", $newcontent);
            $newcontent = preg_replace("/@endif/", "<?PHP } ?>", $newcontent);
            
            //Handle @isset
            $newcontent = preg_replace("/@isset\((.*)\)/", '<?PHP if(isset($1)) { ?>', $newcontent);
            $newcontent = preg_replace("/@!isset\((.*)\)/", '<?PHP if(!isset($1)) { ?>', $newcontent);
            $newcontent = preg_replace("/@endset/", '<?PHP } ?>', $newcontent);
    
            //Handle @for and @foreach
            $newcontent = preg_replace("/@for\((.*)\)/", "<?PHP for($1){ ?>", $newcontent);
            $newcontent = preg_replace("/@foreach\((.*)\)/", "<?PHP foreach($1){ ?>", $newcontent);
            $newcontent = preg_replace("/@endfor/", "<?PHP } ?>", $newcontent);
    
            //Handle @while
            $newcontent = preg_replace("/@while\((.*)\)/", "<?PHP while($1){ ?>", $newcontent);
            $newcontent = preg_replace("/@endwhile\((.*)\)/", "<?PHP } ?>", $newcontent);
            
            //Handle unknown functions {{ }}
            $newcontent = preg_replace("/{{{(.*)}}}/", "<?PHP $1 ?>", $newcontent);
    
            //Handle echo
            $newcontent = preg_replace("/{{(.*)}}/", "<?PHP echo $1; ?>", $newcontent);
    
            //Handle includes
            $newcontent = preg_replace("/@include\((.*)\)/", "<?PHP include('".dirname(__DIR__).'/views/'."$1.php'); ?>", $newcontent);
    
            //Handle Tokens
            $newcontent = preg_replace("/@formtoken/", "<?PHP \\Catnip\\Helpers\\Tokenizer::FormToken(); ?>" ,$newcontent);

            //Handle Loca
            $newcontent = preg_replace("/__\((.*)\)/", "<?PHP echo \\Catnip\\Loca::Trans('$1'); ?>", $newcontent);
            $newcontent = preg_replace("/@loca\((.*)\)(.*)@endloca/", "<?PHP echo \\Catnip\\Loca::Trans('$1','$2'); ?>", $newcontent);

            //Handle URL
            $newcontent = preg_replace("/@url\((.*)\)/", "<?PHP echo('".REMOTE_ROOT."/$1'); ?>", $newcontent);

            //End Cachefunction
            if($cache)
            {
                 $newcontent .= "<?PHP \\Catnip\\Cache::CacheEnd(); ?>";
            }

            return $newcontent;
        }
    }
}
?>
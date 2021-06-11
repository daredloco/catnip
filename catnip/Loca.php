<?PHP
namespace Catnip{
    class Loca{
        public static $language_english = "";
        public static $language_local = "";
        
        protected static $dict = [];

        public static function Load($key = null)
        {
            
            if(is_null($key))
            {
                $key = LOCA_DEFAULT;
            }

            $fname = LOCA_DIRECTORY.'/'.$key.'.json';
            if(file_exists($fname))
            {
                
                //Clear $dict array
                $dict = [];

                //Read content from file
                $fcontent = file_get_contents($fname);
                $fobj = json_decode($fcontent);

                //Set informations from DATA object
                self::$language_english = $fobj->data->english;
                self::$language_local = $fobj->data->local;

                //Read informations from Dictionary
                $farray = $fobj->dictionary;
                foreach ($farray as $locaobj) {
                    self::$dict[$locaobj->key] = $locaobj->value;
                }
            }
        }

        public static function Trans($key)
        {
            if(array_key_exists($key, self::$dict)){
                return self::$dict[$key];
            }
            return "{".$key."}";
        }

        public static function StartPage()
        {
            ob_start();
        }

        public static function EndPage()
        {
            $content = ob_get_contents();
            foreach (self::$dict as $key => $value) {
                $content = str_replace('__('.$key.')', $value, $content);
            }
            ob_end_clean();
            
            echo $content;
        }
    }
}
?>
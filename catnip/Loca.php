<?PHP
namespace Catnip{
    class Loca{
        public static $language_english = "";
        public static $language_local = "";
        
        protected static $dict = [];

        public static function Load($key = null)
        {
            if(!LOCA_ACTIVE)
            {
                return;
            }
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

        public static function Trans($key, $replacements = null)
        {
            if(!LOCA_ACTIVE)
            {
                return;
            }

            if(array_key_exists($key, self::$dict)){
                if(is_null($replacements))
                {
                    return self::$dict[$key];
                }
                $returnkey = self::$dict[$key];

                //If string it needs to be $replacements = "{key1}-value1|{key2}-value2"
                if(!is_array($replacements))
                {
                    $rep = explode('|', $replacements);
                    $reps = [];
                    foreach ($rep as $r) {
                        $splits = explode('-', $r, 2);
                        $reps[trim($splits[0])] = trim($splits[1]);
                    }
                    $replacements = $reps;
                }

                //Replace values from $replacements ("{NAME}" => "Max Mustermann")
                foreach ($replacements as $rkey => $rvalue) {
                    $returnkey = str_replace($rkey, $rvalue, $returnkey);
                }
                return $returnkey;
            }
            return "{".$key."}";
        }

        public static function StartPage()
        {
            if(!LOCA_ACTIVE)
            {
                return;
            }
            ob_start();
        }

        public static function EndPage()
        {
            if(!LOCA_ACTIVE)
            {
                return;
            }
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
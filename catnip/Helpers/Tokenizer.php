<?PHP
namespace Catnip\Helpers{
    class Tokenizer{
        public static function GenerateToken($size = 20){
            $bytes = random_bytes($size);
            return bin2hex($bytes);
        }

        public static function CheckToken($t1, $t2)
        {
            if($t1 === $t2)
            {
                return TRUE;
            }
            return FALSE;
        }

        public static function FormToken()
        {
            $_SESSION["form_token"] = self::GenerateToken();
            echo "\n".'<input type="hidden" value="'.$_SESSION["form_token"].'" id="_token" name="_token">'."\n";
        }
    }
}
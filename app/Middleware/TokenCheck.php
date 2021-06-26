<?PHP
namespace App\Middleware;
class TokenCheck{
    public static function run()
    {
        if(!empty($_POST))
        {
            if(isset($_POST["_token"]) && isset($_SESSION['form_token']))
            {
                if($_POST["_token"] !== $_SESSION["form_token"])
                {
                    //TOKENS NOT EQUAL
                    \Catnip\Route::redirect();
                }
            }else{
                //NOT BOTH TOKEN SET
                \Catnip\Route::redirect();
            }
        }
    }
}
?>
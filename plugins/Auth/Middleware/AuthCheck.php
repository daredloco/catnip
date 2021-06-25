<?PHP
namespace Plugins\Auth\Middleware;

use \Catnip\Route;

class AuthCheck{
    public static function run()
    {
        if(!isset($_SESSION["user"]))
        {
            Route::redirect('login');
            exit();
        }
        $usr = User::Find($_SESSION["user"]);
        if(is_null($usr))
        {
            unlink($_SESSION["user"]);
            Route::redirect('login');
            exit();
        }
    }
}
?>
<?PHP
namespace Plugins\Auth\Controllers;
use \Catnip\View;
use \App\Models\User;
use \Catnip\Route;

class LoginController{
    public static function index()
    {
        if(isset($_SESSION["user"]))
        {
            Route::redirect('middleware');
            return;
        }
        View::RenderFromFile(dirname(__DIR__).'/Views/Login.php', "login", [], false);
    }

    public static function login()
    {
        if($_SESSION["form_token"] !== $_POST["_token"])
        {
            $message = "Your Token has expired!";
            View::RenderFromFile(dirname(__DIR__).'/Views/Login.php', "login", ['message' => $message], false);
            return;
        }
        $mail = $_POST['login_mail'];
        $pass = $_POST['login_pass'];
        
        if(isset($_SESSION["user"]))
        {
            Route::redirect();
            return;
        }

        $user = User::FindByEmail($mail);
        $result = false;
        if(!is_null($user)){
            $result = \Catnip\Helpers\Hasher::Verify($pass, $user->password);
        }
        
        if($result === false)
        {
            $message = "Invalid Login!";
            View::RenderFromFile(dirname(__DIR__).'/Views/Login.php', "login", ['message' => $message], false);
            return;
        }
        $_SESSION["user"] = $user->id;

        Route::redirect('middleware');
    }
    
}
?>
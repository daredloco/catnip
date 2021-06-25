<?PHP
namespace Plugins\Auth\Controllers;
use \Catnip\View;
use \App\Models\User;
use \Catnip\Helpers\Hasher;
use \Catnip\Route;

class RegisterController{
    public static function index()
    {
        if(isset($_SESSION["user"]))
        {
            View::Render("home");
            return;
        }
        View::RenderFromFile(dirname(__DIR__).'/Views/Register.php', "register", [], false);  
    }
    
    public static function register()
    {
        $message = null;
        $username = $_POST["register_name"];
        $email = $_POST["register_mail"];
        $password = $_POST["register_pass"];

        if($_SESSION["form_token"] !== $_POST["_token"])
        {
            $message = "Your Token has expired!";
        }
        $user = User::FindByName($username);
        if(!is_null($user))
        {
            $message = "This username is already in use!";
        }
        $user = User::FindByEmail($email);
        if(!is_null($user))
        {
            $message = "This email is already in use!";
        }
        if(!is_null($message))
        {
            View::RenderFromFile(dirname(__DIR__).'/Views/Register.php', "register", ['message' => $message], false);
            return;
        }
        $model = new User();

        $model->Insert([
            'name' => $username,
            'email' => $email,
            'password' => \Catnip\Helpers\Hasher::Hash($password)
        ]);

        Route::redirect("login");
    }
}
?>
<?PHP
namespace Plugins\Auth\Scripts;
use App\Models\User;

class Auth{
    public static function user()
    {
        if(isset($_SESSION["user"]))
        {
            return User::Find($_SESSION["user"]);
        }
        return null;
    }
}
?>
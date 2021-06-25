<?PHP
namespace Plugins\Auth\Scripts;
use App\Models\User;

class Auth{
    public static function user()
    {
        if(isset($_SESSION["user"]))
        {
            $usr = User::Find($_SESSION["user"]);
            if(is_null($usr))
            {
                unlink($_SESSION["user"]);
                return null;
            }
            return $usr;
        }
        return null;
    }
}
?>
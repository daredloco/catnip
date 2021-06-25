<?PHP
namespace App\Models;
class User extends \Catnip\Model{
    protected static $table;
    protected static $tablename = "users";

    protected static $fillables = [
        'name',
        'email',
        'password',
        'rank'
    ];

    public static function FindByName($name)
    {
        return User::First('name', '=', $name);
    }

    public static function FindByEmail($email)
    {
        return User::First('email', '=', $email);
    }
}
?>
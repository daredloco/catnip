<?PHP
namespace Database\Seeders;
use \App\Models\User;

class UserSeeder{

    public static function run()
    {
        User::Create([
            'name' => 'Admin',
            'email' => 'admin@server.com',
            'password' => \Catnip\Helpers\Hasher::Hash("password")
        ]);
    }
}
?>
<?PHP
namespace App\Models;

use \Catnip\Model;

class User extends Model{
    
    public function __construct()
    {
        $this->Init('users');
    }
}
?>
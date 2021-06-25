<?PHP
namespace App\Controllers;
use \Catnip\View;

class TestController extends Controller{

    public static function index($var1)
    {
        \Plugins\Google\Drive::run();
    }
    
}
?>
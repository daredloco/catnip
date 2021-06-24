<?PHP
namespace App\Controllers;
use \Catnip\View;

class HomeController extends Controller{

    public static function index()
    {
        View::Render('home');
    }
    
}
?>
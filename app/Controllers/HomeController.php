<?PHP
namespace App\Controllers;
use \Catnip\View;
class HomeController{
    public static function index()
    {
        View::Render('home');
    }
}
?>
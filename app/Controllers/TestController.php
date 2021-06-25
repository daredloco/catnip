<?PHP
namespace App\Controllers;
use \Catnip\View;

class TestController extends Controller{

    public static function index($var1)
    {
        $rank = \Plugins\Ranks\Models\Rank::FindByName("user");
        $user = \Plugins\Auth\Scripts\Auth::user();
        \Plugins\Ranks\Scripts\Ranks::AddRank($user, $rank); // Add rank to user
        echo "Has Rank: ".\Plugins\Ranks\Scripts\Ranks::HasRank($user, $rank)."<br>";
        echo "Is Higher Rank: ".\Plugins\Ranks\Scripts\Ranks::HasHigherRank($user, $rank)." ENDE GUT ALLES GUT<br>";
        \Plugins\Ranks\Scripts\Ranks::AddRank($user, $rank); // Add rank to user
        $rank = \Plugins\Ranks\Models\Rank::Find(2);
        echo "Rank Info:<br>".print_r($rank)."<br>";
        //\Plugins\Google\Drive::run();
    }
    
}
?>
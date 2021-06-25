<?PHP
namespace Database\Seeders;
use \Plugins\Ranks\Models\Rank;

class RankSeeder{

    public static function run()
    {
        Rank::Create([
            'name' => 'user',
            'score' => 1
        ]);

        Rank::Create([
            'name' => 'admin',
            'score' => 2 //Higher Rank has bigger score
        ]);
    }
}
?>
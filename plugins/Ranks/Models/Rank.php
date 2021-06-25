<?PHP
namespace Plugins\Ranks\Models;
class Rank extends \Catnip\Model{
    protected static $table;
    protected static $tablename = "ranks";

    protected static $fillables = [
        'name',
        'score'
    ];

    public static function FindByName($name)
    {
        return Rank::Where('name', '=', $name);
    }

    public static function IsHigher(Rank $rankA, Rank $rankB)
    {
        if($rankA->score < $rankB->score)
        {
            return true;
        }
        return false;
    }
}
?>
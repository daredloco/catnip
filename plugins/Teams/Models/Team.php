<?PHP
namespace Plugins\Ranks\Teams;
class Team extends \Catnip\Model{
    protected static $table;
    protected static $tablename = "teams";

    protected static $fillables = [
        'name'
    ];

    public static function FindByName($name)
    {
        return Team::First('name', '=', $name);
    }
}
?>
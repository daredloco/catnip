<?PHP
namespace Plugins\BBCodes\Models;
class BBCode extends \Catnip\Model{
    protected static $table;
    protected static $tablename = "bbcodes";

    protected static $fillables = [
        'tag',
        'bbcode',
        'replacement'
    ];
}
?>
<?PHP
namespace Plugins\Supporter\Models;
class Ticket extends \Catnip\Model{
    protected static $table;
    protected static $tablename = "tickets";

    protected static $fillables = [
        'user_id',
        'title',
        'message',
        'chatlog',
        'status'
    ];
}
?>
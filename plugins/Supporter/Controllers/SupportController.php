<?PHP
namespace Plugins\Supporter\Controllers;
use \Catnip\View;
use \Plugins\Auth\Scripts\Auth;
use \Plugins\Supporter\Models\Ticket;
use \Catnip\Route;

class SupportController{

    public static function index()
    {
        $user = Auth::user();
        $tickets = Ticket::Where('user_id', '=', $user->id);
        View::RenderFromFile(dirname(__DIR__).'/Views/Index.php', "supportindex", ['tickets' => $tickets], false);
    }

    public static function show($id)
    {
        $user = Auth::user();
        $ticket = Ticket::Find($id);
        View::RenderFromFile(dirname(__DIR__).'/Views/Show.php', "supportshow", ['ticket' => $ticket], false);
    }

    public static function create()
    {
        $user = Auth::user();
        View::RenderFromFile(dirname(__DIR__).'/Views/Create.php', "supportcreate", [], false);
    }

    public static function store()
    {
        $user = Auth::user();
        static::index();
    }

    public static function edit($id)
    {
        $user = Auth::user();
        $ticket = Ticket::Find($id);
    }

    public static function update($id)
    {
        $user = Auth::user();
        $ticket = Ticket::Find($id);
    }

    public static function delete($id)
    {
        $user = Auth::user();
        $ticket = Ticket::Find($id);
        $ticket->Delete();
        static::index();
    }
}
?>
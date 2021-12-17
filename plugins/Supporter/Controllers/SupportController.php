<?PHP
namespace Plugins\Supporter\Controllers;
use \Catnip\View;
use \Plugins\Auth\Scripts\Auth;
use \Plugins\Ranks\Scripts\Ranks;
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
        if(!Ranks::UserHasHigherScore(2) && $ticket->user_id != $user->id)
        {
            Route::back();
            return;
        }
        View::RenderFromFile(dirname(__DIR__).'/Views/Show.php', "supportshow", ['ticket' => $ticket], false);
    }

    public static function create()
    {
        View::RenderFromFile(dirname(__DIR__).'/Views/Create.php', "supportcreate", [], false);
    }

    public static function store()
    {
        $user = Auth::user();
        \Catnip\Validator::Validate([
            $_POST[''] => ''
        ]);
        static::index();
    }

    public static function edit($id)
    {
        $user = Auth::user();
        $ticket = Ticket::Find($id);
        if(!Ranks::UserHasHigherScore(2) && $ticket->user_id != $user->id)
        {
            Route::back();
            return;
        }
        View::RenderFromFile(dirname(__DIR__).'/Views/Edit.php', "supportedit", ['ticket' => $ticket], false);
    }

    public static function update($id)
    {
        $user = Auth::user();
        $ticket = Ticket::Find($id);
        static::index();
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
<?PHP
use \Catnip\Route;

// ROUTING
Route::add('/',function(){
    \App\Controllers\HomeController::index();
});

Route::add('/test', function(){
    \App\Controllers\TestController::index();
});

<<<<<<< Updated upstream
=======
//Route::get('/middleware', function(){ echo 'Hello world!';}, [["function" => "\\Plugins\\Auth\\Middleware\\AuthCheck::run", "args" => []]]);
Route::get('/middleware', function(){ echo 'Hello world!';}, ['authcheck']);

//PLUGINS
require_once('../plugins/Auth/Routes/web.php'); //Loads the Auth Plugin routes

>>>>>>> Stashed changes
Route::run('/');
?>
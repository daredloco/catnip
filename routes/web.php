<?PHP
use \Catnip\Route;

// ROUTING
Route::get('/',function(){
    \App\Controllers\HomeController::index();
});

Route::get('/test/([a-zA-Z0-9_-]*)', function($var1){
    \App\Controllers\TestController::index($var1);
});

require_once('../plugins/Auth/Routes/web.php'); //Loads the Auth Plugin routes

Route::run('/');
?>
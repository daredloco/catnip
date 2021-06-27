<?PHP
use \Catnip\Route;

// ROUTING
Route::get('/',function(){
    \App\Controllers\HomeController::index();
});

Route::get('/features',function(){
    \Catnip\View::Render('features');
});

Route::get('/plugins',function(){
    \Catnip\View::Render('plugins');
});

Route::get('/test/([a-zA-Z0-9_-]*)', function($var1){
    \App\Controllers\TestController::index($var1);
}, ['authcheck']);

Route::get('/middleware', function(){ echo 'Hello world!';}, ['authcheck']);

Route::post('/post', function(){});

//PLUGINS
require_once('../plugins/Auth/Routes/web.php'); //Loads the Auth Plugin routes

Route::run('/');
?>
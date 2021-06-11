<?PHP
use \Catnip\Route;

// ROUTING
Route::add('/',function(){
    \App\Controllers\HomeController::index();
});

Route::add('/test', function(){
    \App\Controllers\TestController::index();
});

Route::run('/');
?>
<?PHP
use \CatNip\Route;
// ROUTING
Route::get('/login',function(){
    \Plugins\Auth\Controllers\LoginController::index();
});

Route::post('/login', function(){
    \Plugins\Auth\Controllers\LoginController::login();
});

Route::get('/logout', function(){
    \Plugins\Auth\Controllers\LoginController::logout();
});

Route::get('/register', function(){
    \Plugins\Auth\Controllers\RegisterController::index();
});

Route::post('/register', function(){
    \Plugins\Auth\Controllers\RegisterController::register();
});
?>
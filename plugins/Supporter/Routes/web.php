<?PHP
use \CatNip\Route;
// ROUTING
Route::get('/help',function(){
    \Plugins\Supporter\Controllers\SupportController::index();
}, ['authcheck']);

Route::post('/help', function(){
    \Plugins\Supporter\Controllers\SupportController::login();
}, ['authcheck']);

Route::get('/help/([0-9]*)', function($id){
    \Plugins\Supporter\Controllers\SupportController::show($id);
}, ['authcheck']);

Route::post('/help/([0-9]*)', function($id){
    \Plugins\Supporter\Controllers\SupportController::index($id);
}, ['authcheck']);

Route::delete('/help/([0-9]*)', function($id){
    \Plugins\Supporter\Controllers\SupportController::index($id);
}, ['authcheck']);
?>
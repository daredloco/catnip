<?PHP
if(session_id() == '' || !isset($_SESSION) || session_status() === PHP_SESSION_NONE) {
    session_start();
}
require '../config.php'; //Includes the configuration file
require '../vendor/autoload.php'; //Includes the composer autoloader
require '../routes/web.php'; //Includes the web route
set_error_handler('\\Catnip\\ErrorHandler::Global'); //Sets the custom errorhandler, comment this line out if you wish to use the default errorhandler
?>
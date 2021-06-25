<?PHP
namespace App\Middleware;
class Handler{
    public static $middleware = [
        'authcheck' => '\Plugins\Auth\Middleware\AuthCheck::run'
    ];
}
?>
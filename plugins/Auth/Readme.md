1) Add to \routes\web.php:
    require_once('../plugins/Auth/Routes/web.php');

2) Add to \app\Middleware\Handler.php:
    public static $middleware = [
            'authcheck' => '\Plugins\Auth\Middleware\AuthCheck::run'
    ];

3) Add AuthCheck for Routes in \routes\web.php:
    Route::get(
        '/authtest',
        function(){ echo 'Hello world!';},
        ['authcheck']
        );
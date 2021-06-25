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

4) Edit the Login and Register Views to add your own design.

5) Change $successroute inside .\Controllers\LoginController.php to the url you want to redirect the user after login or if logged in
# Auth Plugin for Catnip

### Usage
* Add to \routes\web.php:
    ```php
    require_once('../plugins/Auth/Routes/web.php');
    ```

* Add to \app\Middleware\Handler.php:
    ```php
    public static $middleware = [
            'authcheck' => '\Plugins\Auth\Middleware\AuthCheck::run'
    ];
    ```

* Add AuthCheck for Routes in \routes\web.php:
    ```php
    Route::get(
        '/authtest',
        function(){ echo 'Hello world!';},
        ['authcheck']
        );
     ```

* Edit the Login and Register Views to add your own design.

* Change ```$successroute``` inside ```.\Controllers\LoginController.php``` to the url you want to redirect the user after login or if logged in

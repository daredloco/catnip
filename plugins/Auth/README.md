# Auth Plugin for Catnip

### Installation
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


* Edit the Login and Register Views to add your own design.

* Change ```$successroute``` inside ```.\Controllers\LoginController.php``` to the url you want to redirect the user after login or if logged in

### Usage
* Add AuthCheck for Routes in \routes\web.php:
    ```php
    Route::get(
        '/authtest',
        function(){ echo 'Hello world!';},
        ['authcheck']
        );
     ```
* To get the User model of the logged in User you can use:
    ```php
    \Plugins\Auth\Scripts\Auth::user(); //You will receive NULL if there is no user or the User object if it exists
    ```
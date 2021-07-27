# Auth Plugin for Catnip

### Installation
* Run ``` php locito make:table User ```
* Replace the content in ```database/Tables/UserTable.php``` with the following lines:
  ```php
    <?PHP
    namespace Database\Tables{
        class UserTable{
            public static function build()
            {
                $table = new \Catnip\Table("users", [
                    "id" => "INT|AUTO_INCREMENT|PRIMARY KEY",
                    "name" => "VARCHAR(255)|NOT NULL",
                    "password" => "VARCHAR(255)|NOT NULL",
                    "email" => "VARCHAR(255)|NOT NULL",
                    "created_at" => "TIMESTAMP|DEFAULT|CURRENT_TIMESTAMP"
                ]);
                $table->Create();
            }

            public static function destroy()
            {
                $table = new \Catnip\Table("users");
                $table->Drop();
            }
        }
    }
    ?>
  ```

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
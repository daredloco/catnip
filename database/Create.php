<?PHP
namespace Database;

class Create{
    public static function Do()
    {
        foreach (glob('database/Tables/*.php') as $file)
        {
            require_once dirname(__DIR__).'/config.php';
            require_once $file;
            // get the file name of the current file without the extension
            // which is essentially the class name
            $class = '\\Database\\Tables\\'.basename($file, '.php');

            if (class_exists($class))
            {
                $table = new $class;
                $table::build();
            }
        }
    }
}
?>
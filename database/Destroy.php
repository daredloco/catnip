<?PHP
namespace Database;

class Destroy{
    public static function Do()
    {
        require_once dirname(__DIR__).'/config.php';
        \Catnip\Database::ForeignCheck(false); //Deactivates the foreign key check temporarily
        foreach (glob('database/Tables/*.php') as $file)
        {
            require_once $file;
            // get the file name of the current file without the extension
            // which is essentially the class name
            $class = '\\Database\\Tables\\'.basename($file, '.php');
            if (class_exists($class))
            {
                $table = new $class;
                $table::destroy();
            }
        }
        \Catnip\Database::ForeignCheck(true); //Reactivates the foreign key check
    }
}
?>
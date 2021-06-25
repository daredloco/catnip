<?PHP
namespace Database;

class Seed{
    public static function Do()
    {
        foreach (glob('database/Seeders/*.php') as $file)
        {
            require_once dirname(__DIR__).'/config.php';
            require_once $file;
            // get the file name of the current file without the extension
            // which is essentially the class name
            $class = '\\Database\\Seeders\\'.basename($file, '.php');

            if (class_exists($class))
            {
                $seeder = new $class;
                $seeder::run();
            }
        }
    }
}
?>
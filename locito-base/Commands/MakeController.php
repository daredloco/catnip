<?php
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class MakeController extends Command
{
    protected $commandName = 'make:controller';
    protected $commandDescription = "Creates a new controller";

    protected $commandArgumentName = "name";
    protected $commandArgumentDescription = "Whats the name of the controller?";

    protected function configure()
    {
        $this
            ->setName($this->commandName)
            ->setDescription($this->commandDescription)
            ->addArgument(
                $this->commandArgumentName,
                InputArgument::REQUIRED,
                $this->commandArgumentDescription
            )
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $name = $input->getArgument($this->commandArgumentName);

        $location = dirname(__DIR__, 2).'/app/Controllers/'.$name.'Controller.php';

        $body = 
'<?PHP
namespace App\Controllers;
use \Catnip\View;
use \Catnip\Route;

use \App\Models\\'.$name.';

class '.$name.'Controller extends Controller{

    public static function index()
    {
        View::Render("'.strtolower($name).'/index");
    }

    public static function show($id)
    {
        $model = '.$name.'::Find($id);
        View::Render("'.strtolower($name).'/show", ["model" => $model]);
    }

    public static function create()
    {
        View::Render("'.strtolower($name).'/create");
    }

    public static function store()
    {
        '.$name.'::Create([
            //Add the values to add here
        ]);
        View::Route();
    }

    public static function edit($id)
    {
        $model = '.$name.'::Find($id);
        View::Render("'.strtolower($name).'/edit", ["model" => $model]);
    }

    public static function update($id)
    {
        $model = '.$name.'::Find($id);
        $model->Update([
            //Add the values to update here
        ]);
        View::Route();
    }

    public static function delete($id)
    {
        $model = '.$name.'::Find($id);
        $model->Delete();
        View::Route();
    }   
}
?>';

        $dbfile = fopen($location, "w") or die("Unable to open file!");
        fwrite($dbfile, $body);
        fclose($dbfile);

        $output->writeln("Controller ".$name. " created!");
        return 1;
    }
}
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

        $location = dirname(__DIR__, 4).'/Controllers/'.$name.'Controller.php';

        $body = 
'<?PHP
#################################################################################################
#                                    IMPORTANT                                                 
#                                                                                              
#   Add "include("../Controllers/'.$name.'Controller.php");" to the "\public\index.php" file!   
#                                                                                              
#                                                                                              
#################################################################################################

namespace Controllers{
    class '.$name.'Controller{
        public static function index()
        {
            include("../Views/'.$name.'.index.php");
        }

        public static function create()
        {
            $var1 = $_POST["form_var1"];

            \Models\\'.$name.'::Create($var1);
        }
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
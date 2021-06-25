<?php
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class MakeModel extends Command
{
    protected $commandName = 'make:model';
    protected $commandDescription = "Creates a new model";

    protected $commandArgumentName = "name";
    protected $commandArgumentDescription = "Whats the name of the model?";

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
        $dbname = strtolower($name).'s';
        $location = dirname(__DIR__, 2).'/app/Models/'.$name.'.php';
        
        $body = 
'<?PHP
namespace App\Models;
class '.$name.' extends \Catnip\Model{
    protected static $table;
    protected static $tablename = "'.strtolower($name).'s";

    protected static $fillables = [
        //"name",
    ];
}
?>';

        $dbfile = fopen($location, "w") or die("Unable to open file!");
        fwrite($dbfile, $body);
        fclose($dbfile);

        $output->writeln("Model ".$name. " created!");
        return 1;
    }
}
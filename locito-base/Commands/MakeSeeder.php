<?php
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class MakeSeeder extends Command
{
    protected $commandName = 'make:seeder';
    protected $commandDescription = "Creates a new seeder";

    protected $commandArgumentName = "name";
    protected $commandArgumentDescription = "Whats the name of the seeder?";

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

        $location = dirname(__DIR__, 2).'/database/Seeders/'.$name.'Seeder.php';

        $body = 
'<?PHP
namespace Database\Seeders;
use \App\Models\\'.$name.';

class '.$name.'Seeder{

    public static function run()
    {
        // '.$name.'::Create([
        //     //Add Content here
        // ]);
    }
}
?>';

        $dbfile = fopen($location, "w") or die("Unable to open file!");
        fwrite($dbfile, $body);
        fclose($dbfile);

        $output->writeln("Seeder ".$name. " created!");
        return 1;
    }
}
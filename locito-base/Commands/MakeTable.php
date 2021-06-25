<?php
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class MakeTable extends Command
{
    protected $commandName = 'make:table';
    protected $commandDescription = "Creates a new table";

    protected $commandArgumentName = "name";
    protected $commandArgumentDescription = "Whats the name of the table?";

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

        $location = dirname(__DIR__, 2).'/database/Tables/'.$name.'Table.php';

        $body = 
'<?PHP
#############################################################################################
#                                     IMPORTANT                                                 
#                                                                                              
#          Run "php locito db:build" after editing the Table to update the database!
#          
#############################################################################################

namespace Database\Tables{

    use \Catnip\Table;

    class '.$name.'Table{
        public static function build()
        {
            $table = new Table("'.strtolower($name).'s", [
                "id" => "INT|AUTO_INCREMENT|PRIMARY KEY",
                "created_at" => "TIMESTAMP|DEFAULT|CURRENT_TIMESTAMP"
            ]);
            $table->Create();
        }

        public static function destroy()
        {
            $table = new Table("'.strtolower($name).'s");
            $table->Drop();
        }
    }
}
?>';

        $dbfile = fopen($location, "w") or die("Unable to open file!");
        fwrite($dbfile, $body);
        fclose($dbfile);

        $output->writeln("Table ".$name. " created!");
        return 1;
    }
}
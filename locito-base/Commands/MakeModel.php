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
        $location = dirname(__DIR__, 4).'/Models/'.$name.'.php';
        
        $body = 
'<?PHP
#################################################################################################
#                                    IMPORTANT                                                 
#                                                                                              
#          Add "include("../Models/'.$name.'.php");" to the "\public\index.php" file!           
#                                                                                              
#                                                                                              
#################################################################################################

namespace Models{
    class '.$name.' {
        public $id;
        public $created_at;

        public function __construct($id)
        {
            $table = new \CatNip\Templates\Table("'.$dbname.'");
            $tmp = $table->First("id", "=", $id);
            if(is_null($tmp))
            {
                return;
            }
            $this->id = $tmp["id"];
            $this->created_at = $tmp["created_at"];
        }

        public function Update()
        {
            $table = new \CatNip\Templates\Table("'.$dbname.'");
            $table->Update([
                
            ],"id", "=", $this->id);
        }

        public static function Create($name, $password, $email)
        {
            $table = new \CatNip\Templates\Table("'.$dbname.'");
            $table->Insert([
                //Enter Content Here
                //"name" => "Max Hardcore"
            ]);

            return null;
            //Add a unique value here like name or such and replace return null; with it!
            //return $table->First("name", "=", $name);
        }

        public static function Find($id)
        {
            $table = new \CatNip\Templates\Table("'.$dbname.'");
            $tmp = $table->First("id", "=", $id);
            if(!is_null($tmp))
            {
                return new '.$name.'($tmp["id"]);
            }
            return null;
        }

        public static function All()
        {
            $table = new \CatNip\Templates\Table("'.$dbname.'");
            $models = [];
            foreach ($table->All() as $tModel) {
                $model = new '.$name.'($tModel["id"]);
                array_push($models, $model);
            }
            return $models;
        }
    }
}
?>';

        $dbfile = fopen($location, "w") or die("Unable to open file!");
        fwrite($dbfile, $body);
        fclose($dbfile);

        $output->writeln("Model ".$name. " created!");
        return 1;
    }
}
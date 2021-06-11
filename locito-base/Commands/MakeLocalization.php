<?php
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class MakeLocalization extends Command
{
    protected $commandName = 'make:loca';
    protected $commandDescription = "Creates a new localization file";

    protected $commandArgumentKey = "key";
    protected $commandArgumentDescriptionKey = "Whats the key of the localization?";

    protected $commandArgumentEnglish = "english";
    protected $commandArgumentDescriptionEnglish = "Whats the english name of the language?";

    protected $commandArgumentLocal = "local";
    protected $commandArgumentDescriptionLocal = "Whats the local name of the language?";

    

    protected function configure()
    {
        $this
            ->setName($this->commandName)
            ->setDescription($this->commandDescription)
            ->addArgument(
                $this->commandArgumentKey,
                InputArgument::REQUIRED,
                $this->commandArgumentDescriptionKey
            )
            ->addArgument(
                $this->commandArgumentEnglish,
                InputArgument::REQUIRED,
                $this->commandArgumentDescriptionEnglish
            )
            ->addArgument(
                $this->commandArgumentLocal,
                InputArgument::REQUIRED,
                $this->commandArgumentDescriptionLocal
            )
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $key = $input->getArgument($this->commandArgumentKey);
        $english_name = $input->getArgument($this->commandArgumentEnglish);
        $local_name = $input->getArgument($this->commandArgumentLocal);

        $location = LOCA_DIRECTORY.'/'.$key.'.json';

        //Load Default Language to enter all values
        $defaultcontent = file_get_contents(LOCA_DIRECTORY.'/'.LOCA_DEFAULT.'.json');
        $defaultobj = json_decode($defaultcontent);
        $defaultdict = $defaultobj->dictionary;
        $body = 
'{
    "data": {
        "local": "'.$local_name.'",
        "english": "'.$english_name.'"
    },
    "dictionary": '.json_encode($defaultdict, JSON_PRETTY_PRINT).'
}';

        $dbfile = fopen($location, "w") or die("Unable to open file!");
        fwrite($dbfile, $body);
        fclose($dbfile);

        $output->writeln("Localization ".$key. " (".$english_name."/".$local_name.") created!");
        return 1;
    }
}
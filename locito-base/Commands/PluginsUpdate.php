<?php
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

class PluginsUpdate extends Command
{
    protected $commandName = 'plugins:update';
    protected $commandDescription = "Update plugin packages";   

    protected function configure()
    {
        $this
            ->setName($this->commandName)
            ->setDescription($this->commandDescription)
            ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        self::listFolderFiles(dirname(__DIR__, 2).DIRECTORY_SEPARATOR.'plugins', $output);
        return 0;
    }

    private static function listFolderFiles($dir, OutputInterface $output)
    {
        $ffs = scandir($dir);

        unset($ffs[array_search('.', $ffs, true)]);
        unset($ffs[array_search('..', $ffs, true)]);

        if (count($ffs) < 1)
            return;

        foreach($ffs as $ff){
            if(is_dir($dir.DIRECTORY_SEPARATOR.$ff)){ 
                if($ff != "vendor")
                {
                    self::listFolderFiles($dir.DIRECTORY_SEPARATOR.$ff, $output);
                }
                
            }
            else{
                if($ff == "composer.json")
                {
                    $output->writeln("Start updating ".$dir."...");
                    $process = new Process(["composer","install"]);
                    $process->setWorkingDirectory($dir);
                    $process->run();
                    if (!$process->isSuccessful()) {
                        throw new ProcessFailedException($process);
                    }else{
                        $output->writeln($dir." updated!");
                    }
                } 
            }
        }
    }
}
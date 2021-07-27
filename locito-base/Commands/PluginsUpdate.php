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
        $output->writeln("Updating all Plugins. This can take some while, depending on your machine, internet and amount of plugins!");

        $sTime = microtime(true);
        self::listFolderFiles(dirname(__DIR__, 2).DIRECTORY_SEPARATOR.'plugins', $output);
        $eTime = microtime(true);

        $output->writeln("All plugins updated after ".round($eTime-$sTime,2)."s");
        return 0;
    }

    private static function listFolderFiles($dir, OutputInterface $output)
    {
        $ffs = scandir($dir);

        $dirstr = str_replace(dirname(__DIR__, 2).DIRECTORY_SEPARATOR.'plugins'.DIRECTORY_SEPARATOR,"",$dir);

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
                    $sTime = microtime(true);
                    $output->writeln("Start updating Plugin \"".$dirstr."\"");
                    $process = new Process(["composer","update"]);
                    $process->setTimeout(3600);
                    $process->setWorkingDirectory($dir);
                    $process->run(function ($type, $buffer) {
                        echo $buffer;
                     });
                    if (!$process->isSuccessful()) {
                        throw new ProcessFailedException($process);
                    }else{
                        $eTime = microtime(true);
                        $output->writeln("Plugin \"".$dirstr."\" updated (".round($eTime-$sTime,2)."s)");
                    }
                } 
            }
        }
    }
}
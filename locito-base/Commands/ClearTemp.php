<?php
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

class ClearTemp extends Command
{
    protected $commandName = 'clear:temp';
    protected $commandDescription = "Clear temp folder";   

    protected function configure()
    {
        $this
            ->setName($this->commandName)
            ->setDescription($this->commandDescription)
            ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln("Deleting temporary files...");
        $files = glob(dirname(__DIR__,2).'/temp/*');
        foreach($files as $file){
            if(is_file($file)) {
                unlink($file);
            }
        }
        $output->writeln("Done!");
        return 0;
    }
}
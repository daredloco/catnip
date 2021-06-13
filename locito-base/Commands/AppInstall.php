<?php
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

class AppInstall extends Command
{
    protected $commandName = 'app:install';
    protected $commandDescription = "Update packages";   

    protected function configure()
    {
        $this
            ->setName($this->commandName)
            ->setDescription($this->commandDescription)
            ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $process = new Process(["composer","install"]);
        $process->setWorkingDirectory(getcwd());
        $process->run();
        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }
        $output->writeln("Root composer OK");
        
        $locitodir = getcwd().DIRECTORY_SEPARATOR.'locito-base';
        $process->setWorkingDirectory($locitodir);
        $process->run();
        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }
        $output->writeln("Locito composer OK");
        $output->writeln("Packages installed successfuly!");

        return 0;
    }
}
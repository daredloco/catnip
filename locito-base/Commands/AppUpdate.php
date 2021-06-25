<?php
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

class AppUpdate extends Command
{
    protected $commandName = 'app:update';
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
        $begTime = microtime(true);
        $sTime = microtime(true);
        $process = new Process(["composer","update"]);
        $process->setWorkingDirectory(getcwd());
        $process->run();
        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }
        $eTime = microtime(true);
        $output->writeln("Root composer OK (".round($eTime-$sTime, 2)."s)");
        
        $sTime = microtime(true);
        $locitodir = getcwd().DIRECTORY_SEPARATOR.'locito-base';
        $process->setWorkingDirectory($locitodir);
        $process->run();
        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }
        $eTime = microtime(true);
        $output->writeln("Locito composer OK (".round($eTime-$sTime, 2)."s)");

        $endTime = microtime(true);
        $output->writeln("Packages updated successfuly! (".round($endTime-$begTime, 2)."s)");

        return 0;
    }
}
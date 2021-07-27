<?php
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\ArrayInput;

class AppInstall extends Command
{
    protected $commandName = 'app:install';
    protected $commandDescription = "First time installation";

    protected function configure()
    {
        $this
            ->setName($this->commandName)
            ->setDescription($this->commandDescription)
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln("Starting first time installation... This can take some while depending on your installed plugins!");
        $appupdate = $this->getApplication()->find('app:update');
        $pluginsupdate = $this->getApplication()->find('plugins:update');

        $appupdate->run($input, $output);
        $pluginsupdate->run($input, $output);
        return 1;
    }
}
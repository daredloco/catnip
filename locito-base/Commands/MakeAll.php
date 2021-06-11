<?php
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\ArrayInput;

class MakeAll extends Command
{
    protected $commandName = 'make:all';
    protected $commandDescription = "Creates a new Controller, Model and Table";

    protected $commandArgumentName = "name";
    protected $commandArgumentDescription = "Whats the name of all?";

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
        $commandModel = $this->getApplication()->find('make:model');
        $commandTable = $this->getApplication()->find('make:table');
        $commandController = $this->getApplication()->find('make:controller');
        
        $arguments = ["name" => $name];
        $inputarray = new ArrayInput($arguments);
        $commandModel->run($inputarray, $output);
        $commandTable->run($inputarray, $output);
        $commandController->run($inputarray, $output);
        return 1;
    }
}
<?php
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class MakeView extends Command
{
    protected $commandName = 'make:view';
    protected $commandDescription = "Creates a new view";

    protected $commandArgumentName = "name";
    protected $commandArgumentDescription = "Whats the name of the view?";

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

        $location = dirname(__DIR__, 4).'/Views/'.$name.'.php';

        $body = 
'@include(layout/header)
<div id="app" class="container">
<!-- Place Content here -->
</div>
@include(layout/footer)';

        $dbfile = fopen($location, "w") or die("Unable to open file!");
        fwrite($dbfile, $body);
        fclose($dbfile);

        $output->writeln("View ".$name. " created!");
        return 1;
    }
}
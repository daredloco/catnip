<?php
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class DatabaseBuild extends Command
{
    protected $commandName = 'db:build';
    protected $commandDescription = "Builds the database structure";

    protected $commandOptionName = "fresh";
    protected $commandOptionDescription = 'Deletes the old database before creating the new one';  

    protected $commandSeedName = "seed";
    protected $commandSeedDescription = "Seeds the database after adding the tables";

    protected function configure()
    {
        $this
            ->setName($this->commandName)
            ->setDescription($this->commandDescription)
            ->addOption(
                $this->commandOptionName,
                null,
                InputOption::VALUE_NONE,
                $this->commandOptionDescription
             )
             ->addOption(
                 $this->commandSeedName,
                 null,
                 InputOption::VALUE_NONE,
                 $this->commandSeedDescription
             )
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        if ($input->getOption($this->commandOptionName)) {
            $output->writeln("Cleaning Database");
            $sTime = microtime(true);
            $location = dirname(__DIR__, 2).'/database/Destroy.php';
            require_once($location);
            \Database\Destroy::Do();
            $eTime = microtime(true);
            $output->writeln("Database cleaned! (".($eTime-$sTime)."ms)");
        }

        $output->writeln("Start building the Database");
        $sTime = microtime(true);
        $location = dirname(__DIR__, 2).'/database/Create.php';
        require_once($location);
        \Database\Create::Do();
        $eTime = microtime(true);
        $output->writeln("Database built! (".($eTime-$sTime)."ms)");

        if ($input->getOption($this->commandSeedName)) {
            $output->writeln("Seeding Database");
            $sTime = microtime(true);
            $location = dirname(__DIR__, 2).'/database/Seed.php';
            require_once($location);
            \Database\Seed::Do();
            $eTime = microtime(true);
            $output->writeln("Database seeded! (".($eTime-$sTime)."ms)");
        }
        return 1;
    }
}
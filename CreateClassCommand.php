<?php
// CreateClassCommand.php
namespace Dal;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Dal\Creator\Creator;

require_once 'creator.class.php';

class CreateClassCommand extends Command
{
	protected function configure()
	{
		 $this
        // the name of the command (the part after "console")
        ->setName('app:create-class')

        // the short description shown while running "php bin/console list"
        ->setDescription('Creates a new object based on yml config in entity dir.')

        // the full command description shown when running the command with
        // the "--help" option
        ->setHelp('This command allows you create object based on yml entity schema')
    ;
	}

	protected function execute(InputInterface $input, OutputInterface $output)
	{
		// outputs multiple lines to the console (adding "\n" at the end of each line)
    $output->writeln([
        'Class Creator',
        '============',
        '',
    ]);
    $schemas = array_diff(scandir('entity'), array('..', '.'));
    foreach ($schemas as $schema){
    	Creator::buildObject('entity/'.$schema);
    	$output->writeln('entity/'.$schema." transformed!");
    }

    $output->writeln("Task completed!");
	}
}
<?php

declare(strict_types=1);

namespace App\Application\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class HelloWorldCommand extends Command
{
  protected static $defaultName = 'hello:world';

  protected function configure()
  {
    $this->setDescription('Outputs: Hello World!');
  }

  public function execute(InputInterface $input, OutputInterface $output)
  {
    $output->writeln('Hello World!');
    return Command::SUCCESS;
  }
}
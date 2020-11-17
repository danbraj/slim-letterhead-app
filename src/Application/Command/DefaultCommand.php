<?php

declare(strict_types=1);

namespace App\Application\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class DefaultCommand extends Command
{
  protected static $defaultName = 'hello:greetings';

  protected function configure()
  {
    $this->setDescription('Greetings');
  }

  public function execute(InputInterface $input, OutputInterface $output)
  {
    $output->writeln('Welcome to Slim 4 Letterhead App');
    return Command::SUCCESS;
  }
}
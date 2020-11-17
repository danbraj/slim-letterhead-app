#!/usr/bin/env php
<?php

use App\Application\Command\DefaultCommand;
use App\Application\Command\HelloWorldCommand;
use Symfony\Component\Console\Application;

require __DIR__ . '/../vendor/autoload.php';

$application = new Application();

$default = new DefaultCommand();

$application->add($default);
$application->add(new HelloWorldCommand());
$application->setDefaultCommand($default->getName());

$application->run();
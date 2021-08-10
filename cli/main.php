#!/usr/bin/env php
<?php
require __DIR__ . '/vendor/autoload.php';

use Symfony\Component\Console\Application;

$application = new Application('Symfony DEV CLI', '1.0');

$application->add(new \SymfonyDevCli\Command\CreateProjectCommand());

$application->run();

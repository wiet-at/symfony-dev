#!/usr/bin/env php
<?php

ini_set('phar.readonly', 'Off');

$src = realpath(__DIR__ . '/../cli');
$target = realpath(__DIR__ . '/../docker');

if (!$src || !$target) {
    exit(1);
}

$target .= '/symfony-dev-cli.phar';

if (file_exists($target)) {
    unlink($target);
}

$phar = new Phar($target);
$phar->startBuffering();
$phar->buildFromDirectory($src);
$phar->setStub('#!/usr/bin/env php' . PHP_EOL . Phar::createDefaultStub('main.php'));
$phar->stopBuffering();

chmod($target, 0755);

echo 'Successfully created symfony-dev-cli.phar' . PHP_EOL;



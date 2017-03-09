<?php declare(strict_types = 1);
require_once __DIR__ . '/bootstrap.php';

$arguments = ['php', 'test.php', '--env', 'prod', '--debug', '--msg', 'ala'];

$commandLine = (new \Brzuchal\Console\ArrayCommandLineParser($arguments))->parse();
print_r($commandLine->toArray());
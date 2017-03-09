<?php declare(strict_types=1);
require_once __DIR__ . '/bootstrap.php';

$definition = new \Brzuchal\Console\CommandLineDefinition([
    new \Brzuchal\Console\ArgumentDefinition('command'),
    new \Brzuchal\Console\OptionDefinition('env', 'e'),
    new \Brzuchal\Console\OptionDefinition('file', 'f'),
    new \Brzuchal\Console\OptionDefinition('count', 'c'),
]);

$parser = new \Brzuchal\Console\ArrayCommandLineParser($_SERVER['argv'], $_SERVER['PWD'], $definition);

/** @var \Brzuchal\Console\CommandLine $commandLine */
$commandLine = $parser->parse();
print_r($commandLine->toArray());
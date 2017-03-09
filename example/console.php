<?php declare(strict_types = 1);
require_once __DIR__ . '/bootstrap.php';

//$console = new \Brzuchal\Console\Console(null, fopen('test.log', 'w+'));
$console = new \Brzuchal\Console\Console();
$console->writeln("\033[0;37m==============================================================\033[0m");

$console->writeln("\033[1;32mWriting works!\033[0m");
$console->writeln("\033[1;33mReading\033[0m:");

$read = $console->read();
$console->writeln(sprintf("\033[1;33mReaded\033[0m: %s", $read));

$read = $console->readln("\033[1;31mWrite your name\033[0m: ");
$console->writeln(sprintf("\033[1;33mHello\033[0m: %s", $read));
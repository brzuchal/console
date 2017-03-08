<?php declare(strict_types=1);
namespace Brzuchal\Console;

interface CommandLineParser
{
    public function parse() : CommandLine;
}
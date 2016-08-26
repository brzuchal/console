<?php
/**
 * Created by PhpStorm.
 * User: mbrzuchalski
 * Date: 25.08.16
 * Time: 12:08
 */
namespace PHP\CLI;

/**
 * Interface ParameterParser
 * @package PHP\CLI
 * @author Michał Brzuchalski <m.brzuchalski@madkom.pl>
 */
interface CommandLineParser
{
    public function parse() : CommandLine;
}
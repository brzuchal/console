<?php
/**
 * Created by PhpStorm.
 * User: mbrzuchalski
 * Date: 25.08.16
 * Time: 12:08
 */
namespace PHP\Console;

/**
 * Interface ParameterParser
 * @package PHP\Console
 * @author Michał Brzuchalski <m.brzuchalski@madkom.pl>
 */
interface ParameterParser
{
    public function parse() : array;
}
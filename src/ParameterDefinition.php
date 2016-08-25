<?php
/**
 * Created by PhpStorm.
 * User: mbrzuchalski
 * Date: 25.08.16
 * Time: 12:28
 */
namespace PHP\Console;

/**
 * Class Parameter
 * @package PHP\Console
 * @author Michał Brzuchalski <m.brzuchalski@madkom.pl>
 */
interface ParameterDefinition
{
    public function getName() : string;
    public function isRequired() : bool;
    public function isValueRequired() : bool;
}

<?php
/**
 * Created by PhpStorm.
 * User: mbrzuchalski
 * Date: 25.08.16
 * Time: 12:06
 */
namespace PHP\Console;

/**
 * Class Argument
 * @package PHP\Console
 * @author Michał Brzuchalski <m.brzuchalski@madkom.pl>
 */
class Argument implements Parameter
{
    /**
     * Retrieves argument name
     * @return string
     */
    public function getName() : string
    {
        // TODO: Implement getName() method.
    }
    
    /**
     * Checks if argument has value
     * @return bool
     */
    public function hasValue() : bool
    {
        // TODO: Implement hasValue() method.
    }

    /**
     * Retrieves argument value
     * @return string
     */
    public function getValue() : string
    {
        // TODO: Implement getValue() method.
    }
}

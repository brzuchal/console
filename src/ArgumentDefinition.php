<?php
/**
 * Created by PhpStorm.
 * User: mbrzuchalski
 * Date: 25.08.16
 * Time: 12:30
 */
namespace PHP\Console;

/**
 * Class ArgumentDefinition
 * @package PHP\Console
 * @author Michał Brzuchalski <m.brzuchalski@madkom.pl>
 */
class ArgumentDefinition implements ParameterDefinition
{
    /**
     * Retrieve argument name
     * @return string
     */
    public function getName() : string
    {
        // TODO: Implement getName() method.
    }

    /**
     * Checks if argument is required
     * @return bool
     */
    public function isRequired() : bool
    {
        // TODO: Implement isRequired() method.
    }

    /**
     * Checks if value is required
     * @return bool
     */
    public function isValueRequired() : bool
    {
        // TODO: Implement isValueRequired() method.
    }
}

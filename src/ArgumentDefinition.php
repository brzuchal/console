<?php
/**
 * Created by PhpStorm.
 * User: mbrzuchalski
 * Date: 25.08.16
 * Time: 12:30
 */
namespace PHP\CLI;

/**
 * Class ArgumentDefinition
 * @package PHP\CLI
 * @author Michał Brzuchalski <m.brzuchalski@madkom.pl>
 */
class ArgumentDefinition implements ParameterDefinition
{
    /**
     * @var string Holds argument name
     */
    protected $name;
    /**
     * @var bool Holds argument existence requirement
     */
    protected $required;

    public function __construct(string $name, bool $required = false)
    {
        $this->name = $name;
        $this->required = $required;
    }

    /**
     * Retrieve argument name
     * @return string
     */
    public function getName() : string
    {
        return $this->name;
    }

    /**
     * Checks if argument is required
     * @return bool
     */
    public function isRequired() : bool
    {
        return $this->required;
    }
}

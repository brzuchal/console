<?php
/**
 * Created by PhpStorm.
 * User: mbrzuchalski
 * Date: 25.08.16
 * Time: 12:06
 */
namespace PHP\CLI;

/**
 * Class Argument
 * @package PHP\CLI
 * @author Michał Brzuchalski <m.brzuchalski@madkom.pl>
 */
class Argument implements Parameter
{
    /**
     * @var string Holds argument name
     */
    protected $name;
    /**
     * @var mixed Holds argument value
     */
    protected $value;

    /**
     * Argument constructor.
     * @param string $name Name
     * @param $value
     */
    public function __construct(string $name, $value)
    {
        $this->name = $name;
        $this->value = $value;
    }

    /**
     * Retrieves argument name
     * @return string
     */
    public function getName() : string
    {
        return $this->name;
    }
    
    /**
     * Checks if argument has value
     * @return bool
     */
    public function hasValue() : bool
    {
        return !empty($this->value);
    }

    /**
     * Retrieves argument value
     * @return string
     */
    public function getValue() : string
    {
        return $this->value;
    }
}

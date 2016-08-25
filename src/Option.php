<?php
/**
 * Created by PhpStorm.
 * User: mbrzuchalski
 * Date: 25.08.16
 * Time: 12:16
 */
namespace PHP\Console;

/**
 * Class Option
 * @package PHP\Console
 * @author Michał Brzuchalski <m.brzuchalski@madkom.pl>
 */
class Option implements Parameter
{
    /**
     * @var string Holds option name
     */
    private $name;
    /**
     * @var string|bool Holds option value
     */
    private $value;

    /**
     * Option constructor.
     * @param string $name Name
     * @param mixed $value Value
     * @param ParameterDefinition|null $parameterDefinition Definition
     */
    public function __construct(string $name, $value)
    {
        $this->name = $name;
        $this->value = $value;
    }

    /**
     * Retrieves option name
     * @return string
     */
    public function getName() : string
    {
        return $this->name;
    }

    /**
     * Checks if option has value
     * @return bool
     */
    public function hasValue() : bool
    {
        return !empty($this->value);
    }

    /**
     * Retrieves option value
     * @return string
     */
    public function getValue() : string
    {
        return $this->value;
    }
}

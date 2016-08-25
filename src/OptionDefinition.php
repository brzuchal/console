<?php
/**
 * Created by PhpStorm.
 * User: mbrzuchalski
 * Date: 25.08.16
 * Time: 12:37
 */
namespace PHP\Console;

/**
 * Class OptionDefinition
 * @package PHP\Console
 * @author Michał Brzuchalski <m.brzuchalski@madkom.pl>
 */
class OptionDefinition implements ParameterDefinition
{
    /**
     * @var string Option name
     */
    private $name;
    /**
     * @var string Option short name
     */
    private $shortName;
    /**
     * @var bool Require flag
     */
    private $required;
    /**
     * @var bool value require flag
     */
    private $valueRequired;

    /**
     * OptionDefinition constructor.
     * @param string $name Name
     * @param string $shortName Short name
     * @param bool $required Require flag
     * @param bool $valueRequired Value required flag
     */
    public function __construct(string $name, string $shortName, bool $required = false, bool $valueRequired = false)
    {
        $this->name = $name;
        $this->shortName = $shortName;
        $this->required = $required;
        $this->valueRequired = $valueRequired;
    }

    /**
     * Retrieve option name
     * @return string
     */
    public function getName() : string
    {
        return $this->name;
    }

    /**
     * Retrieve option short name
     * @return string
     */
    public function getShortName() : string
    {
        return $this->shortName;
    }

    /**
     * Checks if option is required
     * @return bool
     */
    public function isRequired() : bool
    {
        return $this->required;
    }

    /**
     * Checks if option value is required
     * @return bool
     */
    public function isValueRequired() : bool
    {
        return $this->valueRequired;
    }
}

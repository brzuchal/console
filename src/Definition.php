<?php
/**
 * Created by PhpStorm.
 * User: mbrzuchalski
 * Date: 25.08.16
 * Time: 12:32
 */
namespace PHP\Console;

/**
 * Class Definition
 * @package PHP\Console
 * @author Michał Brzuchalski <m.brzuchalski@madkom.pl>
 */
class Definition
{
    /**
     * @var ParameterDefinition[] Holds argument and option definitions
     */
    protected $definitions = [];

    /**
     * Definition constructor.
     * @param ParameterDefinition[] $definitions Argument and option definitions
     */
    public function __construct(array $definitions = [])
    {
        foreach ($definitions as $definition) {
            if ($definition instanceof ParameterDefinition) {
                $this->definitions[] = $definition;
            }
        }
    }

    /**
     * Checks if argument definition exists by name
     * @param string $name Argument name
     * @return bool
     */
    public function hasArgumentDefinition(string $name) : bool
    {
        foreach ($this->definitions as $definition) {
            if ($definition instanceof ArgumentDefinition && $definition->getName() == $name) {
                return true;
            }
        }
        
        return false;
    }

    /**
     * Retrieve argument definition by name
     * @param string $name Argument name
     * @return ArgumentDefinition
     */
    public function getArgumentDefinition(string $name) : ArgumentDefinition
    {
        foreach ($this->definitions as $definition) {
            if ($definition instanceof ArgumentDefinition && $definition->getName() == $name) {
                return $definition;
            }
        }
    }

    /**
     * Checks if option definition exists by name
     * @param string $name Option definition name
     * @return bool
     */
    public function hasOptionDefinition(string $name) : bool
    {
        foreach ($this->definitions as $definition) {
            if ($definition instanceof OptionDefinition) {
                if ($definition->getName() == $name || $definition->getShortName() == $name) {
                    return true;
                }
            }
        }

        return false;
    }

    /**
     * Retrieve option definition by name
     * @param string $name Option definition name
     * @return OptionDefinition
     */
    public function getOptionDefinition(string $name) : OptionDefinition
    {
        foreach ($this->definitions as $definition) {
            if ($definition instanceof OptionDefinition) {
                if ($definition->getName() == $name || $definition->getShortName() == $name) {
                    return $definition;
                }
            }
        }
    }
}

<?php
/**
 * Created by PhpStorm.
 * User: mbrzuchalski
 * Date: 25.08.16
 * Time: 12:20
 */
namespace PHP\Console;

/**
 * Class ArrayParameterParser
 * @package PHP\Console
 * @author Michał Brzuchalski <m.brzuchalski@madkom.pl>
 */
class ArrayParameterParser implements ParameterParser
{
    /**
     * @var Definition Holds argument and option definitions
     */
    protected $definition;
    /**
     * @var array Holds parameters to parse
     */
    protected $parameters;

    /**
     * ArrayParameterParser constructor.
     * @param string[] $parameters Parameters to parse
     * @param Definition|null $definition Definition
     */
    public function __construct(array $parameters, Definition $definition = null)
    {
        $this->definition = $definition;
        $this->parameters = $parameters;
    }

    /**
     * Parses parameters
     * @return Parameter[]
     */
    public function parse() : array
    {
        $parameters = [];
        while ($parameter = current($this->parameters)) {
            if ($this->isOption($parameter)) {
                $name = $this->getOptionName($parameter);

                if ($this->definition instanceof Definition && $this->definition->hasOptionDefinition($name)) {
                    $optionDefinition = $this->definition->getOptionDefinition($name);
                    $name = $optionDefinition->getName();
                }

                if ($this->hasOptionValue($parameter)) {
                    $parameters[] = new Option($name, $this->getOptionValue($parameter));
                } else {
                    $next = next($this->parameters);
                    if ($optionDefinition instanceof OptionDefinition && $optionDefinition->isValueRequired()) {
                        if (!$this->isOption($next)) {
                            $parameters[] = new Option($name, $next);
                        } else {
                            throw new \UnexpectedValueException("Missing option {$name} value");
                        }
                    } elseif (false !== $next && !$this->isOption($next)) {
                        $parameters[] = new Option($name, $next);
                    } else {
                        $parameters[] = new Option($name, true);
                    }
                    prev($this->parameters);
                }
            }
            if (!next($this->parameters)) {
                break;
            }
        }

        return $parameters;
    }

    private function isOption(string $parameter) : bool
    {
        return 0 === strpos($parameter, '-');
    }

    private function isShortOption(string $parameter) : bool
    {
        return $this->isOption($parameter) && ('-' != substr($parameter, 1, 1));
    }

    private function getOptionName(string $parameter) : string
    {
        if ($this->isShortOption($parameter)) {
            return substr($parameter, 1, 1);
        }

        $valuePosition = strpos($parameter, '=');
        if ($valuePosition) {
            return substr($parameter, 2, $valuePosition - 2);
        }

        return substr($parameter, 2);
    }

    private function hasOptionValue(string $parameter) : bool
    {
        if ($this->isShortOption($parameter) && strlen($parameter) > 2) {
            return true;
        }
        if (strlen($parameter) == 2) {
            return false;
        }

        return strpos(ltrim($parameter, '-'), '=') !== false;
    }

    private function getOptionValue(string $parameter) : string
    {
        $valuePosition = strpos($parameter, '=');

        if ($this->isShortOption($parameter) && false === $valuePosition) {
            return substr($parameter, 2);
        }

        return substr($parameter, $valuePosition + 1);
    }
}

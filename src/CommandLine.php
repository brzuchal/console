<?php
/**
 * Created by PhpStorm.
 * User: mbrzuchalski
 * Date: 26.08.16
 * Time: 09:43
 */
namespace PHP\CLI;

use InvalidArgumentException;

/**
 * Class Command
 * @package PHP\CLI
 * @author Michał Brzuchalski <m.brzuchalski@madkom.pl>
 */
class CommandLine
{
    /**
     * @var string Holds command filename
     */
    protected $command;
    /**
     * @var Parameter[] Holds arguments and options
     */
    protected $parameters = [];
    /**
     * @var string Holds current working directory
     */
    protected $cwd;

    public function __construct(string $command, array $parameters = [], string $cwd = null)
    {
        $this->command = $command;
        foreach ($parameters as $parameter) {
            if ($parameter instanceof Parameter) {
                if ($parameter instanceof Argument && $this->hasArgument($parameter->getName())) {
                    throw new InvalidArgumentException("Given argument: {$parameter->getName()} already exists");
                }
                if ($parameter instanceof Option && $this->hasOption($parameter->getName())) {
                    throw new InvalidArgumentException("Given option: {$parameter->getName()} already exists");
                }
                $this->parameters[] = $parameter;
            }
        }
        $this->cwd = $cwd;
    }

    /**
     * Retrieves command name
     * @return string
     */
    public function getCommand() : string
    {
        return $this->command;
    }

    /**
     * Checks if argument exists by name
     * @param string $name Argument name
     * @return bool
     */
    public function hasArgument(string $name) : bool
    {
        foreach ($this->parameters as $parameter) {
            if ($parameter instanceof Argument && $parameter->getName() == $name) {
                return true;
            }
        }

        return false;
    }

    /**
     * Retrieve argument by name
     * @param string $name Argument name
     * @return Argument
     */
    public function getArgument(string $name) : Argument
    {
        foreach ($this->parameters as $parameter) {
            if ($parameter instanceof Argument && $parameter->getName() == $name) {
                return $parameter;
            }
        }
    }

    /**
     * Checks if option exists by name
     * @param string $name
     * @return bool
     */
    public function hasOption(string $name) : bool
    {
        foreach ($this->parameters as $parameter) {
            if ($parameter instanceof Option && $parameter->getName() == $name) {
                return true;
            }
        }

        return false;
    }

    /**
     * Retrieve option by name
     * @param string $name
     * @return Option
     */
    public function getOption(string $name) : Option
    {
        foreach ($this->parameters as $parameter) {
            if ($parameter instanceof Option && $parameter->getName() == $name) {
                return $parameter;
            }
        }
    }

    /**
     * retrieves current working directory
     * @return string
     */
    public function getCwd() : string
    {
        return $this->cwd;
    }
}

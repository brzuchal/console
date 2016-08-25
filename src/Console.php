<?php
/**
 * Created by PhpStorm.
 * User: mbrzuchalski
 * Date: 25.08.16
 * Time: 12:04
 */
namespace PHP\Console;

use InvalidArgumentException;

/**
 * Class Console
 * @package PHP\Console
 * @author Michał Brzuchalski <m.brzuchalski@madkom.pl>
 */
class Console
{
    /**
     * @var Parameter[] Holds arguments and options
     */
    protected $parameters = [];
    /**
     * @var resource
     */
    private $input;
    /**
     * @var resource
     */
    private $output;
    /**
     * @var resource
     */
    private $error;

    /**
     * Console constructor.
     * @param array $parameters
     * @throws InvalidArgumentException
     */
    public function __construct(array $parameters = [], resource $input = null, resource $output = null, resource $error = null)
    {
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
        $this->input = is_null($input) ? fopen('php://STDIN', 'r') : $input;
        $this->output = is_null($output) ? fopen('php://STDOUT', 'w') : $output;
        $this->error = is_null($error) ? fopen('PHP://STDERR', 'w') : $error;
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

    public function write(string $message)
    {
        fwrite($this->output, $message);
    }

    public function read(int $length = 128) : string
    {
        return fread($this->input, $length);
    }
}

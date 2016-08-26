<?php
/**
 * Created by PhpStorm.
 * User: mbrzuchalski
 * Date: 25.08.16
 * Time: 12:04
 */
namespace PHP\CLI;


/**
 * Class Console
 * @package PHP\CLI
 * @author Michał Brzuchalski <m.brzuchalski@madkom.pl>
 */
class Console
{
    /**
     * @var resource
     */
    protected $input;
    /**
     * @var resource
     */
    protected $output;
    /**
     * @var resource
     */
    protected $error;

    /**
     * Console constructor.
     * @param resource $input
     * @param resource $output
     * @param resource $error
     */
    public function __construct($input = null, $output = null, $error = null)
    {
        if (is_null($input)) {
            $this->input = fopen('php://STDIN', 'r');
        } else {
            if (!@fstat($input)) {
                throw new \InvalidArgumentException('Invalid input stream given');
            }
            $this->input = $input;
        }
        if (is_null($output)) {
            $this->output = fopen('php://STDOUT', 'r');
        } else {
            if (!@fstat($output)) {
                throw new \InvalidArgumentException('Invalid output stream given');
            }
            $this->output = $output;
        }
        if (is_null($error)) {
            $this->error = fopen('php://STDERR', 'r');
        } else {
            if (!@fstat($error)) {
                throw new \InvalidArgumentException('Invalid error stream given');
            }
            $this->error = $error;
        }
    }

    public function write(string $message)
    {
        fwrite($this->output, $message);
    }

    public function writeln(string $message)
    {
        $this->write($message . PHP_EOL);
    }

    public function dump($variable)
    {
        $this->write(print_r($variable, true));
    }

    public function read(int $length = 128) : string
    {
        return fread($this->input, $length);
    }

    public function readln(string $prompt = '') : string
    {
        $this->write($prompt);

        return stream_get_line($this->input, 1024, PHP_EOL);
    }
}

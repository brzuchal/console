<?php declare(strict_types=1);
namespace Brzuchal\Console;

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

    public function __construct($input = null, $output = null, $error = null)
    {
        if (null === $input) {
            $this->input = \fopen('php://STDIN', 'rb');
        } else {
            if (!@\fstat($input)) {
                throw new \InvalidArgumentException('Invalid input stream given');
            }
            $this->input = $input;
        }
        if (null === $output) {
            $this->output = \fopen('php://STDOUT', 'rb');
        } else {
            if (!@\fstat($output)) {
                throw new \InvalidArgumentException('Invalid output stream given');
            }
            $this->output = $output;
        }
        if (null === $error) {
            $this->error = \fopen('php://STDERR', 'rb');
        } else {
            if (!@\fstat($error)) {
                throw new \InvalidArgumentException('Invalid error stream given');
            }
            $this->error = $error;
        }
    }

    public function write(string $message) : void
    {
        \fwrite($this->output, $message);
    }

    public function writeln(string $message) : void
    {
        $this->write($message . PHP_EOL);
    }

    public function dump($variable) : void
    {
        $this->write(\print_r($variable, true));
    }

    public function read(int $length = 128) : string
    {
        return \fread($this->input, $length);
    }

    public function readln(string $prompt = '') : string
    {
        $this->write($prompt);

        return \stream_get_line($this->input, 1024, PHP_EOL);
    }
}

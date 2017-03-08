<?php declare(strict_types=1);
namespace Brzuchal\Console;

use Psr\Log\AbstractLogger;

class ConsoleLogger extends AbstractLogger
{
    /**
     * @var Console
     */
    private $console;

    public function __construct(Console $console)
    {
        $this->console = $console;
    }

    public function log($level, $message, array $context = array())
    {
        if (empty($context)) {
            $this->console->writeln($message);
            return;
        }
        $this->console->write($message);
        $this->console->dump($context);
    }
}

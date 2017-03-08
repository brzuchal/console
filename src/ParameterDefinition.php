<?php declare(strict_types=1);
namespace Brzuchal\Console;

interface ParameterDefinition
{
    public function getName() : string;
    public function isRequired() : bool;
}

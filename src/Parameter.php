<?php declare(strict_types=1);
namespace Brzuchal\Console;

interface Parameter
{
    public function getName() : string;
    public function hasValue() : bool;
    public function getValue() : ?string;
}
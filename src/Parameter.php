<?php
/**
 * Created by PhpStorm.
 * User: mbrzuchalski
 * Date: 25.08.16
 * Time: 12:05
 */
namespace PHP\CLI;

/**
 * Interface Parameter
 * @package PHP\CLI
 * @author Michał Brzuchalski <m.brzuchalski@madkom.pl>
 */
interface Parameter
{
    public function getName() : string;
    public function hasValue() : bool;
    public function getValue() : string;
}
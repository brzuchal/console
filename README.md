PHP Console and Parameter Handling
==================================

Purpose of this project is to provide modern and complete API for console and parameter handling in CLI.

## Install


## Examples

The simplest way to retrieve parameters from CLI:

```php
$parser = new \PHP\Console\ArrayParameterParser($_SERVER['argv']);
$parameters = $parser->parse();
```

Which for `php test.php command --env=prod --debug -f -c` gives:

```
Array
(
    [0] => PHP\Console\Option Object
        (
            [name:PHP\Console\Option:private] => env
            [value:PHP\Console\Option:private] => prod
            [parameterDefinition:PHP\Console\Option:private] => 
        )

    [1] => PHP\Console\Option Object
        (
            [name:PHP\Console\Option:private] => debug
            [value:PHP\Console\Option:private] => 1
            [parameterDefinition:PHP\Console\Option:private] => 
        )

    [2] => PHP\Console\Option Object
        (
            [name:PHP\Console\Option:private] => f
            [value:PHP\Console\Option:private] => 1
            [parameterDefinition:PHP\Console\Option:private] => 
        )
        
    [3] => PHP\Console\Option Object
        (
            [name:PHP\Console\Option:private] => c
            [value:PHP\Console\Option:private] => 
            [parameterDefinition:PHP\Console\Option:private] => 
        )
        
)
```

There is also a way to retrieve parameters with it's definitions and their requirements:

```php
$definition = new \PHP\Console\Definition([
    new \PHP\Console\ArgumentDefinition('command'),
    new \PHP\Console\OptionDefinition('env', 'e'),
    new \PHP\Console\OptionDefinition('file', 'f'),
    new \PHP\Console\OptionDefinition('count', 'c'),
]);
$parser = new \PHP\Console\ArrayParameterParser($_SERVER['argv']);
$parameters = $parser->parse();
```

Which also validates if options have values and are required.
Parsing command `php test.php command --env=prod --debug -f -c` gives:

```
Array
(
    [0] => PHP\Console\Option Object
        (
            [name:PHP\Console\Option:private] => env
            [value:PHP\Console\Option:private] => prod
        )

    [1] => PHP\Console\Option Object
        (
            [name:PHP\Console\Option:private] => debug
            [value:PHP\Console\Option:private] => 1
        )

    [2] => PHP\Console\Option Object
        (
            [name:PHP\Console\Option:private] => file
            [value:PHP\Console\Option:private] => 1
        )

    [3] => PHP\Console\Option Object
        (
            [name:PHP\Console\Option:private] => count
            [value:PHP\Console\Option:private] => 1
        )

)
```

## TODO

[x] Parse options from array
[ ] Parse options from string
[ ] Validates required values
[ ] Provide default values
[ ] Parse arguments from array
[ ] Parse arguments from string
[ ] Validates existence of arguments

## License

The MIT License (MIT)

Copyright (c) 2016 Michał Brzuchalski <michal.brzuchalski@gmail.com>

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OFc MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.

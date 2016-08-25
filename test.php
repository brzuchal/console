<?php

require_once "vendor/autoload.php";

$_SERVER['argv'] = explode(' ', 'php test.php command --env=prod --debug -f -c');


$definition = new \PHP\Console\Definition([
    new \PHP\Console\ArgumentDefinition('command'),
    new \PHP\Console\OptionDefinition('env', 'e'),
    new \PHP\Console\OptionDefinition('file', 'f'),
    new \PHP\Console\OptionDefinition('count', 'c'),
]);

$parser = new \PHP\Console\ArrayParameterParser($_SERVER['argv'], $definition);
$parameters = $parser->parse();

print_r($parameters);
die();

print_r($definition);

$examples = [
    ['php', 'test.php', '--env=prod', '--debug', '--msg=ala'],
    ['php', 'test.php', '--env', 'prod', '--debug', '--msg', 'ala'],
    ['php', 'test.php', '-e=prod', '-d', '-m=ala'],
    ['php', 'test.php', '-e', 'prod', '-d', '-m', 'ala'],
    ['php', 'test.php', '-eprod'],
];

$flatten = function (array $parameters) {
    $result = [];
    /** @var \PHP\Console\Parameter[] $parameters */
    foreach ($parameters as $parameter) {
        $result[$parameter->getName()] = $parameter->getValue();
    }

    return $result;
};

foreach ($examples as $example) {
    printf("\033[0;37mParsing: \033[0;32m%s\033[0m\n", implode(' ', $example));
    $arrayParser = new \PHP\Console\ArrayParameterParser($example, $definition);
    $parameters = $arrayParser->parse();
    $flatParams = $flatten($parameters);
    if ((array_key_exists('env', $flatParams) && $flatParams['env'] != 'prod') || !array_key_exists('env', $flatParams)) {
        print("\033[0;31mError parsing\033[0;37m\n");

        var_dump(
            $flatParams['env'],
            (array_key_exists('env', $flatParams) && 'prod' != $flatParams['env']),
            !array_key_exists('env', $flatParams)
        );

        print_r($parameters);
        print_r($flatParams);
    } else {
        print("\033[0;32mSuccessfully parsed env...\033[0m\n");
    }

    print("\033[0;37mAlternatively parsed params (without definition)\033[0m\n");
    $arrayParser = new \PHP\Console\ArrayParameterParser($example);
    $altParameters = $flatten($arrayParser->parse());
    print_r($altParameters);

    print("\033[0m\n=========================================================\n");


}

//print_r($parameters);
//print_r($flatten($parameters));
//
$console = new \PHP\Console\Console($parameters);
print_r($console);

$console->write(sprintf("\033[1;32mWriting works!\033[0m\n"));

$console->write(sprintf("\033[1;33mReading\033[0m:"));

$read = $console->read();

var_dump($read);
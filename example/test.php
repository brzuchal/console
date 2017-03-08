<?php declare(strict_types=1);
require_once __DIR__ . '/../vendor/autoload.php';

$exclude = 'XDG_SEAT|XDG_SESSION_ID|LC_IDENTIFICATION|GIO_LAUNCHED_DESKTOP_FILE_PID|' .
    'GNOME_KEYRING_CONTROL|GNOME_DESKTOP_SESSION_ID|DEFAULTS_PATH|QT_QPA_PLATFORMTHEME|JAVA_HOME|' .
    'PAPERSIZE|IM_CONFIG_PHASE|QT4_IM_MODULE|CLUTTER_IM_MODULE|XMODIFIERS|SSH_AUTH_SOCK|' .
    'XDG_SESSION_PATH|XAUTHORITY|XDG_SESSION_DESKTOP|GDMSESSION|QT_IM_MODULE|GIO_LAUNCHED_DESKTOP_FILE|' .
    'UPSTART_EVENTS|XDG_CONFIG_DIRS|MANDATORY_PATH|UPSTART_SESSION|LIBVIRT_DEFAULT_URI|DESKTOP_SESSION|XDG_RUNTIME_DIR|' .
    'GTK_IM_MODULE|GTK_MODULES|IBUS_DISABLE_SNOOPER|TERMINATOR_UUID|UPSTART_INSTANCE|QT_ACCESSIBILITY|' .
    'ORBIT_SOCKETDIR|XDG_SEAT_PATH|XDG_DATA_DIRS|COMPIZ_BIN_PATH|COMPIZ_CONFIG_PROFILE|XDG_GREETER_DATA_DIR|' .
    'GTK2_MODULES|GPG_AGENT_INFO|SHLVL|XDG_VTNR|GDM_LANG|SESSIONTYPE|XDG_SESSION_TYPE|DBUS_SESSION_BUS_ADDRESS|' .
    'XDG_CURRENT_DESKTOP|GNOME_KEYRING_PID|QT_LINUX_ACCESSIBILITY_ALWAYS_ON|LSCOLORS|' .
    'RANCHER_URL|RANCHER_ACCESSS_KEY|RANCHER_SECRET_KAY|PHPBREW_HOME|PHPBREW_ROOT|PHPBREW_LOOKUP_PREFIX|PHPBREW_PHP|PHPBREW_PATH|' .
    'PATH_WITHOUT_PHPBREW|PHPBREW_BIN|PHPBREW_VERSION_REGEX|UPSTART_JOB';

foreach (\explode('|', $exclude) as $key) {
    unset($_SERVER[$key]);
}
\ksort($_SERVER);

//$console = new \Brzuchal\Console\Console(null, fopen('test.log', 'w+'));
$console = new \Brzuchal\Console\Console();
$console->writeln("\033[0;37m==============================================================\033[0m");
//$console->dump($console);
//$command = [
//    'bin' => PHP_BINARY,
//    'pwd' => [$_SERVER['PWD'], getcwd()],
//    'argv' => [$argv, $_SERVER['argv']],
//    'env' => $_ENV,
//    'script' => [
//        $_SERVER['PHP_SELF'],
//        $_SERVER['SCRIPT_NAME'],
//        $_SERVER['SCRIPT_FILENAME'],
//        $_SERVER['PATH_TRANSLATED'],
//    ],
//];

//$console->write("\033[0;32m\$_SERVER\033[0m: ");
//$console->dump($_SERVER);


$definition = new \Brzuchal\Console\CommandLineDefinition([
    new \Brzuchal\Console\ArgumentDefinition('command'),
    new \Brzuchal\Console\OptionDefinition('env', 'e'),
    new \Brzuchal\Console\OptionDefinition('file', 'f'),
    new \Brzuchal\Console\OptionDefinition('count', 'c'),
]);

$parser = new \Brzuchal\Console\ArrayCommandLineParser($_SERVER['argv'], $_SERVER['PWD'], $definition);

/** @var \Brzuchal\Console\CommandLine $commandLine */
$commandLine = $parser->parse();

$console->dump($commandLine);

$console->writeln("\033[1;32mWriting works!\033[0m");
$console->writeln("\033[1;33mReading\033[0m:");

$read = $console->read();
$console->writeln(sprintf("\033[1;33mReaded\033[0m: %s", $read));

$read = $console->readln("\033[1;31mWrite your name\033[0m: ");
$console->writeln(sprintf("\033[1;33mHello\033[0m: %s", $read));

exit(0);

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
    /** @var \Brzuchal\Console\Parameter[] $parameters */
    foreach ($parameters as $parameter) {
        $result[$parameter->getName()] = $parameter->getValue();
    }

    return $result;
};

foreach ($examples as $example) {
    printf("\033[0;37mParsing: \033[0;32m%s\033[0m\n", implode(' ', $example));
    $arrayParser = new \Brzuchal\Console\ArrayCommandLineParser($example, $definition);
    $commandLine = $arrayParser->parse();
    $flatParams = $flatten($commandLine);
    if ((array_key_exists('env', $flatParams) && $flatParams['env'] != 'prod') || !array_key_exists('env', $flatParams)) {
        print("\033[0;31mError parsing\033[0;37m\n");

        var_dump(
            $flatParams['env'],
            (array_key_exists('env', $flatParams) && 'prod' != $flatParams['env']),
            !array_key_exists('env', $flatParams)
        );

        print_r($commandLine);
        print_r($flatParams);
    } else {
        print("\033[0;32mSuccessfully parsed env...\033[0m\n");
    }

    print("\033[0;37mAlternatively parsed params (without definition)\033[0m\n");
    $arrayParser = new \Brzuchal\Console\ArrayCommandLineParser($example);
    $altParameters = $flatten($arrayParser->parse());
    print_r($altParameters);

    print("\033[0m\n=========================================================\n");


}

//print_r($parameters);
//print_r($flatten($parameters));
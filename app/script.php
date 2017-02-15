<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Aura\Cli\CliFactory;

$cliFactory = new CliFactory;
$stdio = $cliFactory->newStdio();
$context = $cliFactory->newContext($GLOBALS);

$options = [];

$getOptions = $context->getopt($options);

if (($input = $getOptions->get(1)) == null) {
    print "You must provide at least one parameter\n";
    exit();
}

if( !file_exists($input)) {
    print "The specified input file does not exist\n";
    exit();
}
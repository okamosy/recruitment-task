<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Aura\Cli\CliFactory;

$cliFactory = new CliFactory;
$context = $cliFactory->newContext($GLOBALS);

$options = [
    'input::'
];

$getOptions = $context->getopt($options);

$input = $getOptions->get('--input');
if($input == null)
{
    // The --input flag wasn't used, so try it without the flag
    $input = $getOptions->get(1);
}
if ($input == null) {
    print "You must provide at least one parameter\n";
    exit();
}

if( !file_exists($input)) {
    print "The specified input file does not exist\n";
    exit();
}
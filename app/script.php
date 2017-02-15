<?php

require_once __DIR__ . '/autoload.php';

use Aura\Cli\CliFactory;
use App\Reader\Reader;

$cliFactory = new CliFactory;
$context = $cliFactory->newContext($GLOBALS);

$options = [
    'input::'
];

$getOptions = $context->getopt($options);

if (($input = $getOptions->get('--input')) == null) {
    // The --input flag wasn't used, so try it without the flag
    if (($input = $getOptions->get(1)) == null) {
        print "You must provide at least one parameter\n";
        exit();
    }
}

if (!file_exists($input)) {
    print "The specified input file does not exist\n";
    exit();
}

$reader = new Reader($input);

$sum = $reader->getSum();
print $sum;

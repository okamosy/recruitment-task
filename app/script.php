<?php

require_once __DIR__ . '/autoload.php';

use Aura\Cli\CliFactory;
use App\Reader\Reader;
use App\Writer\Writer;

$cliFactory = new CliFactory;
$context = $cliFactory->newContext($GLOBALS);

$options = [
    'input::',
    'output::',
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

$outputFile = $getOptions->get('--output');

if ($outputFile === $input) {
    print "The specified output file cannot be the same as the input\n";
    exit();
}

try {
    $reader = new Reader($input);

    $sum = $reader->getSum();
    if ($outputFile != null) {
        $writer = new Writer($outputFile);
        $writer->write($sum);
        print "The result is in {$outputFile}\n";
    } else {
        print $sum;
    }
}
catch( InvalidArgumentException $e ) {
    print $e->getMessage();
}

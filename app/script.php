<?php

require_once __DIR__ . '/autoload.php';

use Aura\Cli\CliFactory;
use Aura\Cli\Context\OptionFactory;
use App\Help\ScriptHelp;
use App\Reader\Reader;
use App\Writer\Writer;

$cliFactory = new CliFactory;
$stdio = $cliFactory->newStdio();
$context = $cliFactory->newContext($GLOBALS);

$help = new ScriptHelp(new OptionFactory());
$getOptions = $context->getopt($help->getOptions());

if (($input = $getOptions->get('--input')) == null) {
    // The --input flag wasn't used, so try it without the flag
    if (($input = $getOptions->get(1)) == null) {
        $stdio->outln($help->getHelp('script.php'));
        exit();
    }
}

if (!file_exists($input)) {
    $stdio->errln("The specified input file does not exist");
    exit();
}

$outputFile = $getOptions->get('--output');

if ($outputFile === $input) {
    $stdio->errln("The specified output file cannot be the same as the input");
    exit();
}

try {
    $reader = new Reader($input);

    $sum = $reader->getSum();
    if ($outputFile != null) {
        $writer = new Writer($outputFile);
        $writer->write($sum);
        $stdio->outln("The result is in {$outputFile}");
    } else {
        print $sum;
    }
}
catch( InvalidArgumentException $e ) {
    $stdio->errln($e->getMessage());
}

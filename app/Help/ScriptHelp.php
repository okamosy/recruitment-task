<?php

namespace App\Help;

use Aura\Cli\Help;

class ScriptHelp extends Help
{
    protected function init()
    {
        $this->setSummary('Sums up an input file.');
        $this->setUsage('[<arg1>]');
        $this->setOptions(
            [
                'input:' => 'The input file to be read in.',
                'output:' => 'The target file to output the result to.',
            ]
        );
        $this->setDescr(<<<DESC
Reads the input file and sums up all the values found within.  The output
    is sent to either stdout or the specified output file.

    Supported input formats are csv,xml,yml
DESC
        );
    }
}

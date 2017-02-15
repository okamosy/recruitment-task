<?php

namespace App\Reader;


use App\Reader\Helper\CsvHelper;

class Reader
{
    protected $data;

    public function __construct($inputFile)
    {
        $pathInfo = pathinfo($inputFile);
        switch ($pathInfo['extension']) {
            case 'csv':
                $csvHelper = new CsvHelper($inputFile);
                $this->data = $csvHelper->get();
                break;
        }
    }

}

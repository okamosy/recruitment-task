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

    public function getSum()
    {
        $sum = 0;
        foreach($this->data as $record) {
            $sum += $record['value'];
        }

        return $sum;
    }
}

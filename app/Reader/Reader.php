<?php

namespace App\Reader;


use App\Reader\Helper\CsvHelper;
use App\Reader\Helper\XmlHelper;
use App\Reader\Helper\YmlHelper;

class Reader
{
    protected $data = [];

    public function __construct($inputFile)
    {
        $pathInfo = pathinfo($inputFile);
        switch ($pathInfo['extension']) {
            case 'csv':
                $csvHelper = new CsvHelper($inputFile);
                $this->data = $csvHelper->get();
                break;
            case 'yml':
                $ymlHelper = new YmlHelper($inputFile);
                $this->data = $ymlHelper->get();
                break;
            case 'xml':
                $xmlHelper = new XmlHelper($inputFile);
                $this->data = $xmlHelper->get();
                break;
            default:
                throw new \InvalidArgumentException("The specified input file is not a supported file type: {$pathInfo['extension']}");
        }
    }

    public function getSum()
    {
        $sum = 0;
        foreach ($this->data as $record) {
            $sum += $record['value'];
        }

        return $sum;
    }
}

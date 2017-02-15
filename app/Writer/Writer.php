<?php

namespace App\Writer;


class Writer
{
    protected $filePath;

    public function __construct($filePath)
    {
        $pathInfo = pathinfo($filePath);
        if (!file_exists($pathInfo['dirname'])) {
            mkdir($pathInfo['dirname'], 0777, true);
        }
        $this->filePath = $filePath;
    }

    public function write($data)
    {
        $handler = fopen($this->filePath, 'w');
        fputs($handler, $data);
        fclose($handler);
    }
}
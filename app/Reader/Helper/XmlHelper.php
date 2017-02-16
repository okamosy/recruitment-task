<?php

namespace App\Reader\Helper;


class XmlHelper implements HelperInterface
{
    protected $data = [];

    public function __construct($filename)
    {
        $xml = simplexml_load_file($filename);

        // This is a quick trick to extract xml into a nice array
        // Okay for small datasets...bad for larger ones
        $json = json_encode($xml);
        $data = json_decode($json, true);

        // Throw away the top 'wrapper' element if it exists
        $firstKey = current(array_keys($data));
        $this->data = is_array($firstKey) ? $data : $data[$firstKey];
    }

    public function get()
    {
        return $this->data;
    }
}

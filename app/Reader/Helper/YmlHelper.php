<?php


namespace App\Reader\Helper;


class YmlHelper implements HelperInterface
{
    protected $data = [];

    public function __construct($filename)
    {
        $data = \Spyc::YAMLLoad($filename);

        // Throw away the top 'wrapper' element if it exists
        $firstKey = current(array_keys($data));
        $this->data = is_array($firstKey) ? $data : $data[$firstKey];
    }

    /**
     * @return array
     */
    public function get()
    {
        return $this->data;
    }
}

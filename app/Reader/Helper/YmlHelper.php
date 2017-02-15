<?php


namespace App\Reader\Helper;


class YmlHelper implements HelperInterface
{
    protected $data = [];

    public function __construct($filename)
    {
        $data = \Spyc::YAMLLoad($filename);
        $this->data = isset($data['users']) ? $data['users'] : $data;
    }

    /**
     * @return array
     */
    public function get()
    {
        return $this->data;
    }
}

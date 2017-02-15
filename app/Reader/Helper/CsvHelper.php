<?php


namespace App\Reader\Helper;


class CsvHelper
{
    protected $headers = false;
    protected $data = [];
    protected $handler = null;

    /**
     * CsvHelper constructor.
     *
     * @param $fileName
     */
    public function __construct($fileName)
    {
        $this->handler = fopen($fileName, 'r');
        $this->headers = fgetcsv($this->handler, 1000, ',');
        $this->read();
    }

    /**
     * Cleans up when the object is destroyed
     */
    public function __destruct()
    {
        if ($this->handler !== null) {
            fclose($this->handler);
        }
    }

    /**
     * Gets the read data.
     *
     * @return array
     */
    public function get()
    {
        return $this->data;
    }

    /**
     * Reads in the data from the current file.
     *
     * @return array
     */
    protected function read()
    {
        while (($row = fgetcsv($this->handler, 1000, ',')) !== false) {
            if ($this->headers) {
                $dataRow = [];
                foreach ($this->headers as $index => $heading) {
                    $dataRow[$heading] = $row[$index];
                }

                $this->data[] = $dataRow;
            } else {
                $this->data[] = $row;
            }
        }
    }
}
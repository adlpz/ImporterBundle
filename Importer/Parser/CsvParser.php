<?php

namespace Netdudes\ImporterBundle\Importer\Parser;

class CsvParser implements ParserInterface
{
    /**
     * @param      $data
     * @param bool $hasHeaders
     *
     * @return array
     */
    public function parse($data, $hasHeaders = true, $delimiter = ',')
    {
        $rows = explode("\n", $data);
        if ($hasHeaders) {
            $headers = $this->parseLine(array_shift($rows), $delimiter);
        } else {
            $headers = range(0, count($this->parseLine($rows[0], $delimiter)));
        }
        $data = [];
        foreach ($rows as $lineNumber => $row) {
            if (!($row = trim($row))) {
                continue;
            }
            $row = $this->parseLine($row, $delimiter);
            $dataRow = [];
            foreach ($row as $index => $cell) {
                $dataRow[$headers[$index]] = $cell;
            }
            $data[$lineNumber] = $dataRow;
        }

        return $data;
    }

    /**
     * @param $row
     *
     * @return array
     */
    public function parseLine($row, $delimiter = ',')
    {
        $enclosure = '"';

        return str_getcsv($row, $delimiter, $enclosure);
    }
}

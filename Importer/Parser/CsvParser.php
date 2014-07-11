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
    public function parse($data, $hasHeaders = true)
    {
        $rows = explode("\n", $data);
        if ($hasHeaders) {
            $headers = $this->parseCsvRow(array_shift($rows));
        } else {
            $headers = range(0, count($this->parseCsvRow($rows[0])));
        }
        $data = [];
        foreach ($rows as $lineNumber => $row) {
            if (!($row = trim($row))) {
                continue;
            }
            $row = $this->parseCsvRow($row);
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
    private function parseCsvRow($row)
    {
        $delimiter = ',';
        $enclosure = '"';

        return str_getcsv($row, $delimiter, $enclosure);
    }
}

<?php

namespace Netdudes\ImporterBundle\Importer\Interpreter\Exception;

use Behat\Gherkin\Exception\Exception;

class DateTimeFormatException extends InterpreterException
{
    protected $value;

    protected $format;

    protected $dateTimeErrors = [];

    public function __toString()
    {
        $dateTimeErrorsPrettyPrint = print_r($this->dateTimeErrors, true);

        return
            $this->message . PHP_EOL .
            "Could not parse \"{$this->value}\" for format \"{$this->format}\". DateTime errors follow:" . PHP_EOL .
            $dateTimeErrorsPrettyPrint;
    }

    /**
     * @param array $dateTimeErrors
     */
    public function setDateTimeErrors($dateTimeErrors)
    {
        $this->dateTimeErrors = $dateTimeErrors;
    }

    /**
     * @return array
     */
    public function getDateTimeErrors()
    {
        return $this->dateTimeErrors;
    }

    /**
     * @param mixed $format
     */
    public function setFormat($format)
    {
        $this->format = $format;
    }

    /**
     * @return mixed
     */
    public function getFormat()
    {
        return $this->format;
    }

    /**
     * @param mixed $value
     */
    public function setValue($value)
    {
        $this->value = $value;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

}

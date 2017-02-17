<?php

namespace App\Service\CurrencyConversion;

use App\Exception\ConsoleApplicationException;

class Client
{
    /**
     * @var string
     */
    protected $location;

    /**
     * @var array
     */
    protected $XmlErrors = [];

    /**
     * Client constructor.
     * @param string $location
     */
    public function __construct($location)
    {
        $this->location = $location;
    }

    /**
     * @return string
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * @param string $location
     */
    public function setLocation($location)
    {
        $this->location = $location;
    }


    /**
     * @return array
     * @throws ConsoleApplicationException
     */
    public function fetchLatestRatesAsObjects()
    {
        $SimpleXMLRates = $this->fetchLatestRates();
        $RatesCollection = [];
        foreach ($SimpleXMLRates as $SimpleXMLRate) {
            $RatesCollection[] = $this->covertSimpleXMLElementToStdClass($SimpleXMLRate);
        }
        return $RatesCollection;
    }

    /**
     * @return \SimpleXMLElement
     * @throws ConsoleApplicationException
     */
    protected function fetchLatestRates()
    {
        $rates = $this->doRequest();
        if (count($this->getXmlErrors()) > 0) {
            throw new ConsoleApplicationException("Could not fetch latest currency rates. Errors: " . print_r($this->getXmlErrors(), true));
        } else {
            return $rates;
        }
    }


    /**
     * @return array
     */
    protected function getXmlErrors()
    {
        return $this->XmlErrors;
    }

    /**
     * @param string $XmlErrors
     */
    protected function setXmlError($XmlErrors)
    {
        $this->XmlErrors[] = $XmlErrors;
    }

    /**
     * @return \SimpleXMLElement
     */
    protected function doRequest()
    {
        libxml_use_internal_errors(true);
        $data = simplexml_load_file($this->getLocation());
        if (!$data) {
            foreach (libxml_get_errors() as $error) {
                $this->setXmlError($error->message);
            }
        }

        return $data;
    }

    /**
     * @param $SimpleXmlElement
     * @return mixed
     */
    private function covertSimpleXMLElementToStdClass($SimpleXmlElement)
    {
        return json_decode(json_encode($SimpleXmlElement));
    }

}
<?php


namespace Countjr\Weather\Resources;

class WeatherResource implements ResourceInterface
{
    private $temperature;
    public function __construct($data)
    {
        $this->temperature = $data['temperature'];
    }

    /**
     * @return mixed
     */
    public function getTemperature()
    {
        return $this->temperature;
    }
}

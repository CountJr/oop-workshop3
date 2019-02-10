<?php

namespace Countjr\Weather;

use Countjr\Weather\Services\ServiceInterface;

class Weather
{
    private $service;

    public function __construct(ServiceInterface $service)
    {
        $this->service = $service;
    }

    public function getWeatherByCity($city)
    {
        return $this->service->getWeatherByCity($city);
    }
}

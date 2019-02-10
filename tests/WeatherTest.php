<?php

namespace Countjr\Weather\Tests;

use Countjr\Weather\Services\ServiceFactory;
use Countjr\Weather\Weather;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;

class WeatherTest extends TestCase
{
    public function testOpenWeather()
    {
        $body = file_get_contents(__DIR__ . '/asserts/openweather');
        $mock = new MockHandler([
            new Response(200, ['X-Foo' => 'Bar'], $body)
        ]);
        $handler = HandlerStack::create($mock);
        $service = ServiceFactory::createService('openweather', '', $handler);
        $weather = new Weather($service);
        $this->assertEquals(277.65, $weather->getWeatherByCity('')->getTemperature());
    }
}

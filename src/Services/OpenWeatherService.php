<?php


namespace Countjr\Weather\Services;

use Countjr\Weather\Resources\WeatherResource;
use GuzzleHttp\Client;

class OpenWeatherService implements ServiceInterface
{
    private $key;
    private $client;

    public function __construct($key, $handler)
    {
        $this->key = $key;
        $uri = 'https://api.openweathermap.org/data/2.5/weather';
        $this->client = new Client([
            'base_uri' => $uri,
            'handler' => $handler,
        ]);
    }

    /**
     * @param $city
     * @return string
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getWeatherByCity($city)
    {
        try {
            $response = $this->client->request('GET', '', [
                'query' => [
                    'q' => $city,
                    'appid' => $this->key,
                ]
            ]);
        } catch (\Exception $exception) {
            throw new \Exception($exception->getMessage());
        }
        return $this->parseResponse($response);
    }

    /**
     * @param $response
     * @return WeatherResource
     */
    private function parseResponse($response)
    {
        $contents = json_decode($response->getBody()->getContents());
        $resource = new WeatherResource([
            'temperature' => $contents->main->temp,
        ]);
        return $resource;
    }
}

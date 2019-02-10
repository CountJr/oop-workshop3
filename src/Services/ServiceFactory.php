<?php


namespace Countjr\Weather\Services;

use Noodlehaus\Config;

class ServiceFactory
{
    public const MAP = [
        'openweather' => 'OpenWeatherService'
    ];

    public const CONFIG_PATH = __DIR__ . '/../../config/config.php';

    /**
     * @param $service
     * @param $key
     * @param null $handler
     * @return mixed
     * @throws \Exception
     */
    public static function createService($service, $key, $handler = null)
    {
        if (!isset(self::MAP[$service])) {
            throw new \Exception('not in map'); // exceptions!!! <@countjr | todo |01:31 PM, 10-Feb-2019>
        }
        $class = '\\Countjr\\Weather\\Services\\' . self::MAP[$service];
        return new $class($key, $handler);
    }
}

#!/usr/bin/env php
<?php

use Countjr\Weather\Services\ServiceFactory;
use Countjr\Weather\Weather;

require_once __DIR__ . '/../vendor/autoload.php';

const EXIT_ERROR_CODE = 1;
const EXIT_SUCCESS_CODE = 0;

$weathercmd = new \Commando\Command();
$weathercmd->option('s')
    ->aka('service')
    ->require()
    ->describe('Name of service')
    ->must(function ($service) {
        return array_key_exists($service, ServiceFactory::MAP);
    });
$weathercmd->option('k')
    ->aka('key')
    ->require()
    ->describe('API key for service');

if ($weathercmd) {
    try {
        $service = ServiceFactory::createService($weathercmd['service'], $weathercmd['key']);
        $weather = new Weather($service);
        print_r($weather->getWeatherByCity('Prague')->getTemperature());
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}

//$handler = new Handler

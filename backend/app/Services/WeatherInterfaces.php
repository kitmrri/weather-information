<?php

namespace App\Services;

interface WeatherInterfaces
{
    public function getConfig(): array;

    public function fetch(array $params): array;
}

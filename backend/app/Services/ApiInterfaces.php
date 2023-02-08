<?php

namespace App\Services;

interface ApiInterfaces
{
    public function getConfig(): array;

    public function fetch(array $params): array;
}

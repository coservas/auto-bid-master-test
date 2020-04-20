<?php

namespace App\DataFixtures;

trait FixturesTrait
{
    private function getDataFromFile(string $pathname): array
    {
        return json_decode(file_get_contents($pathname), true);
    }

    private function getPathToFixtures(): string
    {
        return __DIR__ . '/../../data/fixtures';
    }
}

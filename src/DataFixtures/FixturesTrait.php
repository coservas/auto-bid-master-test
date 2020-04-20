<?php

namespace App\DataFixtures;

trait FixturesTrait
{
    /**
     * @return array<string, array>
     */
    private function getDataFromFile(string $pathname): array
    {
        return json_decode((string)file_get_contents($pathname), true);
    }

    private function getPathToFixtures(): string
    {
        return __DIR__ . '/../../data/fixtures';
    }
}

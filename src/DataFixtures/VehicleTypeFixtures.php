<?php

namespace App\DataFixtures;

use App\Entity\VehicleType;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class VehicleTypeFixtures extends Fixture
{
    private const PATH_TO_FIXTURES = __DIR__ . '/../../data/fixtures';
    private const FILENAME = 'vehicle_types.json';

    public function load(ObjectManager $manager)
    {
        $filepath = sprintf('%s/%s', self::PATH_TO_FIXTURES, self::FILENAME);
        $data = $this->getDataFromFile($filepath);

        foreach ($data as $datum) {
            $code = $datum['code'];
            $desc = $datum['description'];

            $vehicleType = (new VehicleType())
                ->setCode($code)
                ->setDescription($desc);

            $manager->persist($vehicleType);
        }

        $manager->flush();
    }

    private function getDataFromFile(string $pathname)
    {
        return json_decode(file_get_contents($pathname), true);
    }
}

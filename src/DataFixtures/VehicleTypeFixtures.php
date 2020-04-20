<?php

namespace App\DataFixtures;

use App\Entity\VehicleType;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class VehicleTypeFixtures extends Fixture
{
    use FixturesTrait;

    private const FILENAME = 'vehicle_types.json';

    public function load(ObjectManager $manager)
    {
        $data = $this->getDataFromFile(
            sprintf('%s/%s', $this->getPathToFixtures(), self::FILENAME)
        );

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
}

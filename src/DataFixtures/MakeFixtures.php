<?php

namespace App\DataFixtures;

use App\Entity\Make;
use App\Entity\VehicleType;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class MakeFixtures extends Fixture implements DependentFixtureInterface
{
    use FixturesTrait;

    private const FILENAME = 'makes.json';

    public function load(ObjectManager $manager): void
    {
        $data = $this->getDataFromFile(
            sprintf('%s/%s', $this->getPathToFixtures(), self::FILENAME)
        );

        foreach ($data as $datum) {
            $code = $datum['code'];
            $desc = $datum['description'];
            $typeCode = $datum['type'];

            /** @var VehicleType $type */
            $type = $manager->getRepository(VehicleType::class)
                ->findOneBy(['code' => $typeCode]);

            $make = (new Make())
                ->setCode($code)
                ->setDescription($desc)
                ->setType($type);

            $manager->persist($make);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            VehicleTypeFixtures::class
        ];
    }
}

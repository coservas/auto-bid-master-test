<?php

namespace App\DataFixtures;

use App\Entity\Make;
use App\Entity\Model;
use App\Entity\VehicleType;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ModelFixtures extends Fixture implements DependentFixtureInterface
{
    use FixturesTrait;

    private const FILENAME = 'models.json';

    public function load(ObjectManager $manager): void
    {
        $data = $this->getDataFromFile(
            sprintf('%s/%s', $this->getPathToFixtures(), self::FILENAME)
        );

        foreach ($data as $datum) {
            $code = $datum['code'];
            $desc = $datum['description'];
            $typeCode = $datum['type'];
            $group = $datum['group'];

            /** @var VehicleType $type */
            $type = $manager->getRepository(VehicleType::class)
                ->findOneBy(['code' => $typeCode]);

            /** @var Make $make */
            $make = $manager->getRepository(Make::class)
                ->findOneBy(['code' => $group]);

            $model = (new Model())
                ->setCode($code)
                ->setDescription($desc)
                ->setType($type)
                ->setMake($make);

            $manager->persist($model);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            MakeFixtures::class
        ];
    }
}

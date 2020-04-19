<?php

namespace App\DataFixtures;

use App\Entity\Make;
use App\Entity\VehicleType;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class MakeFixtures extends Fixture implements DependentFixtureInterface
{
    private const PATH_TO_FIXTURES = __DIR__ . '/../../data/fixtures';
    private const FILENAME = 'makes.json';

    public function load(ObjectManager $manager): void
    {
        $filepath = sprintf('%s/%s', self::PATH_TO_FIXTURES, self::FILENAME);
        $data = $this->getDataFromFile($filepath);

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

    private function getDataFromFile(string $pathname): array
    {
        return json_decode(file_get_contents($pathname), true);
    }

    public function getDependencies(): array
    {
        return [
            VehicleTypeFixtures::class
        ];
    }
}

<?php

namespace App\DataFixtures;

use DateTime;
use App\Entity\Module;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class ModuleFixtures extends Fixture
{
    public const MODULE_REFERENCE = 'module';
    public function load(ObjectManager $manager): void
    {
        foreach ($this->getFakeModules() as $index => $moduleData) {

            $module = (new Module())
                ->setSerialNumber($moduleData['serial_number'])
                ->setBrand($moduleData['brand'])
                ->setModel($moduleData['model'])
                ->setDescription($moduleData['description'])
                ->setStatus($moduleData['status'])
                ->setUnity($moduleData['unity'])
                ->setMax($moduleData['max'])
                ->setMin($moduleData['min'])
                ->setCreatedAt(new DateTime());

            $manager->persist($module);

            $this->addReference(self::MODULE_REFERENCE . $index, $module);
        }

        $manager->flush();
    }

    private function getFakeModules(): iterable
    {
        yield [
            'serial_number' => '1A2B-3C4D-5E6F-7G8H',
            'brand' => 'Beko',
            'model' => 'E-424',
            'description' => 'American fridge with double door and ice maker',
            'status' => true,
            'unity' => 'C°',
            'min' => '2',
            'max' => '10',
        ];

        yield [
            'serial_number' => 'ABC123456789',
            'brand' => 'Braun',
            'model' => 'BUA6350EU',
            'description' => 'Blood pressure monitor',
            'status' => true,
            'unity' => 'mmHg',
            'min' => '80',
            'max' => '120',
        ];

        yield [
            'serial_number' => 'XY1234567Z',
            'brand' => 'Extech',
            'model' => 'SD700',
            'description' => 'Displays barometric pressure in 3 units of measure: HPA, mmHg and inHg',
            'status' => true,
            'unity' => 'HPA',
            'min' => '800',
            'max' => '1200',
        ];

        yield [
            'serial_number' => '9876-5432-ABCD-EFGH',
            'brand' => 'KDAWN',
            'model' => '137187795',
            'description' => 'Liquid level measurement and control in industrial processes',
            'status' => true,
            'unity' => 'm',
            'min' => '0',
            'max' => '10',
        ];

        yield [
            'serial_number' => '99-00001-12345',
            'brand' => 'Sony',
            'model' => 'SRS-X11',
            'description' => 'Wireless portable speaker',
            'status' => true,
            'unity' => 'dB',
            'min' => '50',
            'max' => '90',
        ];

        yield [
            'serial_number' => 'XA123456VVO',
            'brand' => 'Nest',
            'model' => 'Learning Thermostat',
            'description' => 'Smart thermostat for home heating and cooling',
            'status' => true,
            'unity' => 'C°',
            'min' => '18',
            'max' => '25',
        ];

        yield [
            'serial_number' => '4321-9876-ABCD-LHFS',
            'brand' => 'Philips',
            'model' => 'AC1214/10',
            'description' => 'Air purifier',
            'status' => true,
            'unity' => '%',
            'min' => '30',
            'max' => '50',
        ];

        yield [
            'serial_number' => 'AB951234ZE',
            'brand' => 'Samsung',
            'model' => 'Galaxy Watch Active2',
            'description' => 'Smartwatch',
            'status' => true,
            'unity' => 'bpm',
            'min' => '60',
            'max' => '120',
        ];
        yield [
            'serial_number' => '2B1A-4D8C-5E6F-VGHJ',
            'brand' => 'Fitbit',
            'model' => 'Charge 4',
            'description' => 'Fitness tracker',
            'status' => true,
            'unity' => 'Steps',
            'min' => '5000',
            'max' => '10000',
        ];

        yield [
            'serial_number' => 'AB12-34CD-56EF-78GH',
            'brand' => 'Apple',
            'model' => 'AirPods Pro',
            'description' => 'Wireless earbuds',
            'status' => true,
            'unity' => 'dB',
            'min' => '-30',
            'max' => '30',
        ];
    }
}
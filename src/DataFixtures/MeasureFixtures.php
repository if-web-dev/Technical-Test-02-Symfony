<?php

namespace App\DataFixtures;

use DateTime;
use Faker\Factory;
use App\Entity\Module;
use App\Entity\Measure;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class MeasureFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        // Retrieves references to modules created in previous fixtures
        $modules = [];

        for ($i = 0; $i < 10; $i++) {
            $modules[] = $this->getReference(ModuleFixtures::MODULE_REFERENCE . $i);
        }

        foreach ($modules as $module) {
            $totalMeasures = $faker->numberBetween(10, 50); // Total number of measures generate per module
            $date = $faker->dateTimeBetween('-1 month', 'now');
            $endDate = new DateTime(); // Get the current date and time
            $date = clone $date;

            for ($i = 0; $i < $totalMeasures; $i++) {
                $measure = new Measure();
                $measure->setModule($module);
                $measure->setValue($this->simulateFailure($module));
                $measure->setCreatedAt($date);

                $manager->persist($measure);

                
                //To give one measure by day, it increments the date by an interval
                $date = clone $date;
                $date->modify('+1 day');

                if ($date >= $endDate) {
                    break; // Exit the loop if the date exceeds the current date
                }
            }
        }

        $manager->flush();
    }

    /**
     * Renerates a random floating-point number within the specified range.
     * @var $min
     * @var $max
     */
    private function generateRandomValue(float $min, float $max): float
    {
        return mt_rand($min * 100, $max * 100) / 100;
    }

    /**
     * Returns a random value limited by its min and max from a module or null to simulate a its failure
     * @var $module
     */
    function simulateFailure(Module $module) {
        static $callCount = 0, $failureCount = 0, $failureBool = false;
        $randomValue = rand(1, 30);
        $callCount++;
        
        if($randomValue === 1){
            $failureBool = true;
        }
        
        if($failureBool === true){
            $failureCount++;
        }

        if($callCount === 31){
            $callCount = 1;
            $failureBool = false;
            $failureCount = 0;
        }
        
        if($failureBool === true && $failureCount<=10){
            return null;
        }
        
        return $this->generateRandomValue($module->getMin(), $module->getMax());

    }

    public function getDependencies(): array
    {
        return [
            ModuleFixtures::class,
        ];
    }
}

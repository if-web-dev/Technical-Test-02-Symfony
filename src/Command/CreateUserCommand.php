<?php 

namespace App\Command;


use DateTime;
use App\Entity\Module;
use App\Entity\Measure;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

// the name of the command is what users type after "php bin/console"
#[AsCommand(
    name: 'app:create-datas',
    description: 'Creates new measure.',
    hidden: false
)]
class CreateUserCommand extends Command
{
    //the command description shown when running "php bin/console list"
    protected static $defaultDescription = 'Creates new measure.';

     private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        // 3. Update the value of the private entityManager variable through injection
        $this->entityManager = $entityManager;

        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            // the command help shown when running the command with the "--help" option
            ->setHelp('This command allows you to generate datas')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $modules = $this->entityManager->getRepository(Module::class)->findAll();
    
        //Simulates module failure by returning null 10 times in a row for a module
        foreach ($modules as $module) {
            $randomValue = rand(1, 30);
            if($randomValue === 1 ){
                $module->setStatus(false);
            }
            // Generates a new Measure
            $measure = new Measure();
            if(!$module->getStatus()){
                if($module->getIncrement()<= 10){
                    $measure->setValue(null);
                    $module->setIncrement($module->getIncrement()+1);
                }else{
                    $module->setStatus(true);
                    $measure->setValue($this->generateRandomValue($module->getMin(), $module->getMax()));
                }
            }else{
                $measure->setValue($this->generateRandomValue($module->getMin(), $module->getMax()));
            }
        
            $measure->setModule($module);
            $measure->setCreatedAt(new DateTime());

            // Save the measurement to the database
            $this->entityManager->persist($module);
            $this->entityManager->persist($measure);
        }

        // Executes operations in the database
        $this->entityManager->flush();

        return Command::SUCCESS;

        // or return this if some error happened during the execution
        // (it's equivalent to returning int(1))
        // return Command::FAILURE;

        // or return this to indicate incorrect command usage; e.g. invalid options
        // or missing arguments (it's equivalent to returning int(2))
        // return Command::INVALID
    }

    function generateRandomValue(float $min, float $max): float
    {
        return mt_rand($min * 100, $max * 100) / 100;
    }
    
}
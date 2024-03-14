<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command; // Importing the Command class from Symfony Console component
use Symfony\Component\Console\Input\InputInterface; 
use Symfony\Component\Console\Output\OutputInterface; 
use Doctrine\ORM\EntityManagerInterface; 
use App\Entity\Services; 
use Symfony\Component\Console\Style\SymfonyStyle; 
use Exception; 

class SummaryCommand extends Command // Defining SummaryCommand class, extending Symfony Command class
{
    protected static $defaultName = 'app:summary'; // Setting the command name
    
    private $entityManager; // Declaring private property to hold EntityManager

    public function __construct(EntityManagerInterface $entityManager) // Constructor accepting EntityManager
    {
        $this->entityManager = $entityManager; // Initializing EntityManager
        parent::__construct(); // Calling parent constructor
    }

    protected function configure() // Configuring the command
    {
        $this->setDescription('Summary of services by country'); // Setting command description
    }

    protected function execute(InputInterface $input, OutputInterface $output): int // Method for executing the command
    {
        try { // Handling potential exceptions
            $repository = $this->entityManager->getRepository(Services::class); // Getting repository for Services entity
        
            $io = new SymfonyStyle($input, $output); // Creating SymfonyStyle object for styled output
        
            $servicesSummary = $repository->getServicesSummary(); // Getting services summary from repository
        
            $output->writeln("Services provided by Country:"); // Outputting header
        
            foreach ($servicesSummary as $serviceCount) { // Iterating through service summary
                $io->writeln(sprintf('%s: %d', $serviceCount['country'], $serviceCount['totalServices'])); // Outputting country and total services
            }

            return Command::SUCCESS; // Returning success status
        } catch (Exception $e) { // Catching exceptions
            $output->writeln("<error>An error occurred: {$e->getMessage()}</error>"); // Outputting error message
            return Command::FAILURE; // Returning failure status
        }
    }

    private function fetchSummaryByCountry() // Unused private method
    {
        $repository = $this->entityManager->getRepository(Services::class); // Getting repository for Services entity
        $services = $repository->findAll(); // Fetching all services
        return $services; // Returning services
    }
}

<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command; // Importing the Command class from Symfony Console component
use Symfony\Component\Console\Input\InputArgument; 
use Symfony\Component\Console\Input\InputInterface; 
use Symfony\Component\Console\Output\OutputInterface; 
use Doctrine\ORM\EntityManagerInterface; 
use App\Entity\Services; 
use Exception; // Importing Exception class for error handling

class QueryServicesCommand extends Command // Defining the QueryServicesCommand class which extends Command
{
    protected static $defaultName = 'app:query-services'; // Setting the default name for the command

    private $entityManager; // Declaring a private property to hold the EntityManager

    public function __construct(EntityManagerInterface $entityManager) // Constructor to inject EntityManager
    {
        $this->entityManager = $entityManager; // Injecting EntityManager via constructor injection
        parent::__construct(); // Calling the parent class constructor
    }

    protected function configure() // Method to configure the command
    {
        $this->setDescription('Query services by country code') // Setting the command description
             ->addArgument('countryCode', InputArgument::REQUIRED, 'Country code to query services'); // Adding a required argument 'countryCode'
    }

    protected function execute(InputInterface $input, OutputInterface $output): int // Method to execute the command
    {
        try {
            $countryCode = strtoupper($input->getArgument('countryCode')); // Retrieving the countryCode argument and converting it to uppercase
            $services = $this->fetchServicesByCountry($countryCode); // Fetching services by country code

            if (!empty($services)) { // Checking if services are found
                $output->writeln("Services provided by $countryCode:"); // Outputting a message indicating services found
                foreach ($services as $service) { // Iterating through services
                    $output->writeln("- " . $service->getservice()); // Outputting each service
                }
            } else {
                $output->writeln("No services found for $countryCode."); // Outputting a message indicating no services found
            }

            return Command::SUCCESS; // Returning success status
        } catch (\Exception $e) { // Catching any exceptions that occur
            $output->writeln("An error occurred: " . $e->getMessage()); // Outputting an error message
            return Command::FAILURE; // Returning failure status
        }
    }

    private function fetchServicesByCountry(string $countryCode): array // Method to fetch services by country code
    {
        $repository = $this->entityManager->getRepository(Services::class); // Getting the repository for the Services entity
        return $repository->findBy(['country' => $countryCode]); // Fetching services by country code
    }
}

<?php


namespace App\Tests;

use App\Command\QueryServicesCommand;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Console\Tester\CommandTester;

class QueryServicesCommandTest extends KernelTestCase
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManagerMock;

    protected function setUp(): void
    {
        // Mocking EntityManagerInterface
        $this->entityManagerMock = $this->createMock(EntityManagerInterface::class);
    }

    public function testExecute()
    {
        // Set up EntityManager mock to return dummy data
        $servicesData = [
            (new \App\Entity\Services())->setservice('Portal Technology'),
            (new \App\Entity\Services())->setservice('Behaviour Modification')
        ];
        $repositoryMock = $this->getMockBuilder(\Doctrine\ORM\EntityRepository::class)
            ->disableOriginalConstructor()
            ->getMock();
        $repositoryMock->expects($this->once())
            ->method('findBy')
            ->willReturn($servicesData);
        
        $this->entityManagerMock->expects($this->once())
            ->method('getRepository')
            ->willReturn($repositoryMock);

        // Create the command and inject the mocked dependencies
        $application = new Application(static::createKernel());
        $application->add(new QueryServicesCommand($this->entityManagerMock));

        // Execute the command
        $command = $application->find('app:query-services');
        $commandTester = new CommandTester($command);
        $commandTester->execute([
            'command' => $command->getName(),
            'countryCode' => 'FR'
        ]);

        // Assert the output
        $output = $commandTester->getDisplay();
        $this->assertStringContainsString('Services provided by FR:', $output);
        $this->assertStringContainsString('Portal Technology', $output);
        $this->assertStringContainsString('Behaviour Modification', $output);
    }
}
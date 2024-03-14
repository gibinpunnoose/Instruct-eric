<?php
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Console\Tester\CommandTester;
use App\Command\SummaryCommand;
use App\Repository\ServicesRepository;
use Doctrine\ORM\EntityManagerInterface;

class SummaryCommandTest extends KernelTestCase
{
    public function testExecute()
    {
        self::bootKernel();
        $container = self::$kernel->getContainer();
        $entityManager = $container->get('doctrine')->getManager();

        // Create a mock of the EntityManagerInterface
        $entityManagerMock = $this->getMockBuilder(EntityManagerInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        // Mock the getRepository method of EntityManagerInterface
        $repositoryMock = $this->getMockBuilder(ServicesRepository::class)
            ->disableOriginalConstructor()
            ->getMock();

        $servicesSummary = [
            ['country' => 'A', 'totalServices' => 5],
            ['country' => 'B', 'totalServices' => 10],
            // Add more data if needed
        ];

        $repositoryMock->expects($this->exactly(1))
            ->method('getServicesSummary')
            ->willReturn($servicesSummary);

        $entityManagerMock->expects($this->once())
            ->method('getRepository')
            ->willReturn($repositoryMock);

        // Create a new instance of SummaryCommand with the mocked EntityManagerInterface
        $command = new SummaryCommand($entityManagerMock);

        // Create a CommandTester
        $commandTester = new CommandTester($command);

        // Execute the command
        $commandTester->execute([]);

        // Assert the output
        $output = $commandTester->getDisplay();
        $this->assertStringContainsString('Services provided by Country:', $output);
        $this->assertStringContainsString('A: 5', $output);
        $this->assertStringContainsString('B: 10', $output);
        // Add more assertions if needed
    }
}
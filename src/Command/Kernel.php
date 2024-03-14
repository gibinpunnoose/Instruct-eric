<?php
namespace App\Command;

use Symfony\Component\Console\Application;
use Symfony\Component\Console\CommandLoader\FactoryCommandLoader;
use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\HttpKernel\KernelInterface;

class Kernel extends Bundle
{
    public function registerCommands(Application $application)
    {
        $commandLoader = new FactoryCommandLoader([
            'app:query-services' => function () {
                return new QueryServicesCommand();
            },
            'app:summary' => function () {
                return new SummaryCommand();
            },
        ]);

        $application->setCommandLoader($commandLoader);
    }
}
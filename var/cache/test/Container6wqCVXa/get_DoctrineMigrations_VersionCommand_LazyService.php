<?php

namespace Container6wqCVXa;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class get_DoctrineMigrations_VersionCommand_LazyService extends App_KernelTestDebugContainer
{
    /**
     * Gets the private '.doctrine_migrations.version_command.lazy' shared service.
     *
     * @return \Symfony\Component\Console\Command\LazyCommand
     */
    public static function do($container, $lazyLoad = true)
    {
        include_once \dirname(__DIR__, 4).'/vendor/symfony/console/Command/Command.php';
        include_once \dirname(__DIR__, 4).'/vendor/symfony/console/Command/LazyCommand.php';

        return $container->privates['.doctrine_migrations.version_command.lazy'] = new \Symfony\Component\Console\Command\LazyCommand('doctrine:migrations:version', [], 'Manually add and delete migration versions from the version table.', false, #[\Closure(name: 'doctrine_migrations.version_command', class: 'Doctrine\\Migrations\\Tools\\Console\\Command\\VersionCommand')] function () use ($container): \Doctrine\Migrations\Tools\Console\Command\VersionCommand {
            return ($container->privates['doctrine_migrations.version_command'] ?? $container->load('getDoctrineMigrations_VersionCommandService'));
        });
    }
}

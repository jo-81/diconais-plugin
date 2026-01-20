<?php

namespace Tests\Diconais\Unit;

use Diconais\Container\Container;
use Diconais\Container\Exception\NotFoundException;
use PHPUnit\Framework\TestCase;

class ContainerTest extends TestCase
{
    /**
     * testRegisterService
     *
     * @return void
     */
    public function testRegisterService(): void
    {
        $container = new Container();
        $container->register('env', 'dev');
        $container->register('service', fn () => true);

        // Callback
        $this->assertTrue($container->get('service'));
        $this->assertTrue($container->get('service'));

        // Callback
        $this->assertSame($container->get('env'), 'dev');
    }

    /**
     * testGetServiceNotRegister
     *
     * @return void
     */
    public function testGetServiceNotRegister(): void
    {
        $this->expectException(NotFoundException::class);

        $container = new Container();
        $container->get('not-exist');
    }

    /**
     * testRegisterServiceWithFile
     *
     * @return void
     */
    public function testRegisterServiceWithFile(): void
    {
        $container = new Container();
        $container->loadFromFile(dirname(__DIR__) . '/configuration.php');

        $this->assertTrue($container->get('service'));

        // Fichier qui n'existe pas
        $this->expectException(NotFoundException::class);
        $container->loadFromFile(dirname(__DIR__) . '/not-exist.php');
    }
}

<?php

namespace Diconais\Tests\Unit\Controller;

use Mockery;
use Brain\Monkey;
use PHPUnit\Framework\TestCase;
use Diconais\Core\PostTypeFactory;
use Diconais\Core\TaxonomyFactory;
use Diconais\Controller\KanaController;
use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;

class KanaControllerTest extends TestCase
{
    use MockeryPHPUnitIntegration;

    protected function setUp(): void
    {
        parent::setUp();
        Monkey\setUp();
    }

    protected function tearDown(): void
    {
        Monkey\tearDown();
        parent::tearDown();
    }

    /**
     * -------------------------------------------------------------------------
     * Post type
     * -------------------------------------------------------------------------
     */

    /**
     * testLoadRegistersPostTypeWhenFactoryIsSet
     *
     * @return void
     */
    public function testLoadRegistersPostTypeWhenFactoryIsSet(): void
    {
        $mockFactory = Mockery::mock(PostTypeFactory::class);
        $mockFactory->shouldReceive('set')
            ->once()
            ->with('dn_kana', Mockery::type('array'))
            ->andReturnSelf();

        $mockFactory->shouldReceive('hook')
            ->once()
            ->andReturnNull();

        $controller = new KanaController();
        $controller->setPostTypeFactory($mockFactory);

        $controller->load();
    }

    /**
     * testRegisterPostTypeUsesCorrectPostTypeName
     *
     * @return void
     */
    public function testRegisterPostTypeUsesCorrectPostTypeName(): void
    {
        $mockFactory = Mockery::mock(PostTypeFactory::class);
        $mockFactory->shouldReceive('set')
            ->once()
            ->with('dn_kana', Mockery::type('array'))
            ->andReturnSelf();

        $mockFactory->shouldReceive('hook')
            ->once()
            ->andReturnNull();

        $controller = new KanaController();
        $controller->setPostTypeFactory($mockFactory);

        $controller->registerPostType();
    }

    /**
     * testRegisterPostTypeUsesKanaPostTypeConfiguration
     *
     * @return void
     */
    public function testRegisterPostTypeUsesKanaPostTypeConfiguration(): void
    {
        $mockFactory = Mockery::mock(PostTypeFactory::class);
        $mockFactory->shouldReceive('set')
            ->once()
            ->with('dn_kana', Mockery::on(function ($config) {
                return is_array($config);
            }))
            ->andReturnSelf();

        $mockFactory->shouldReceive('hook')
            ->once()
            ->andReturnNull();

        $controller = new KanaController();
        $controller->setPostTypeFactory($mockFactory);

        $controller->registerPostType();
    }

    /**
     * testFullWorkflow
     *
     * @return void
     */
    public function testFullWorkflow(): void
    {
        $mockFactory = Mockery::mock(PostTypeFactory::class);
        $mockFactory->shouldReceive('set')
            ->once()
            ->with('dn_kana', Mockery::type('array'))
            ->andReturnSelf();

        $mockFactory->shouldReceive('hook')
            ->once()
            ->andReturnNull();

        $controller = (new KanaController())
            ->setPostTypeFactory($mockFactory);

        $controller->load();

        $this->assertInstanceOf(KanaController::class, $controller);
    }

    /**
     * -------------------------------------------------------------------------
     * Taxonomy
     * -------------------------------------------------------------------------
     */

    public function testFullWorkflowForTaxonomy(): void
    {
        $mockFactory = Mockery::mock(TaxonomyFactory::class);
        $mockFactory->shouldReceive('set')
            ->once()
            ->with('dn_kana_type', Mockery::type('array'), Mockery::type('array'))
            ->andReturnSelf();

        $mockFactory->shouldReceive('hook')
            ->once()
            ->andReturnNull();

        $controller = (new KanaController())->setTaxonomyFactory($mockFactory);

        $controller->load();

        $this->assertInstanceOf(KanaController::class, $controller);
    }
}

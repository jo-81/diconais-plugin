<?php

namespace Tests\Diconais\Unit\Core;

use Brain\Monkey;
use Brain\Monkey\Functions;
use PHPUnit\Framework\TestCase;
use Diconais\Core\PostTypeFactory;
use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;

class PostTypeFactoryTest extends TestCase
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
     * testCanCreateInstance
     *
     * @return void
     */
    public function testCanCreateInstance(): void
    {
        $instance = new PostTypeFactory();

        $this->assertInstanceOf(PostTypeFactory::class, $instance);
    }

    /**
     * testSetMethodReturnsSelf
     *
     * @return void
     */
    public function testSetMethodReturnsSelf(): void
    {
        $instance = new PostTypeFactory();
        $result = $instance->set('dn_kana', ['public' => true]);

        $this->assertSame($instance, $result);
    }

    /**
     * testHookAddsActionToInit
     *
     * @return void
     */
    public function testHookAddsActionToInit(): void
    {
        $instance = new PostTypeFactory();
        $instance->set('dn_kana', ['public' => true]);

        Functions\expect('add_action')
            ->once()
            ->with('init', [$instance, 'register'], 10)
            ->andReturnNull();

        $instance->hook();
    }

    /**
     * testHookAcceptsCustomPriority
     *
     * @return void
     */
    public function testHookAcceptsCustomPriority(): void
    {
        $instance = new PostTypeFactory();
        $instance->set('dn_kana', ['public' => true]);
        $priority = 20;

        Functions\expect('add_action')
            ->once()
            ->with('init', [$instance, 'register'], $priority)
            ->andReturnNull();

        $instance->hook($priority);
    }

    /**
     * testRegisterCallsWordpressFunction
     *
     * @return void
     */
    public function testRegisterCallsWordpressFunction(): void
    {
        $post_type = 'dn_kana';
        $data = ['public' => true, 'label' => 'Kana'];

        $instance = new PostTypeFactory();
        $instance->set($post_type, $data);

        Functions\expect('register_post_type')
            ->once()
            ->with($post_type, $data)
            ->andReturnNull();

        $instance->register();
    }
}

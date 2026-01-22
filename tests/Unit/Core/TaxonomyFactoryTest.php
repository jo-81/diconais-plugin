<?php

namespace Tests\Diconais\Unit\Core;

use Brain\Monkey;
use Brain\Monkey\Functions;
use PHPUnit\Framework\TestCase;
use Diconais\Core\TaxonomyFactory;
use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;

class TaxonomyFactoryTest extends TestCase
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
        $instance = new TaxonomyFactory();

        $this->assertInstanceOf(TaxonomyFactory::class, $instance);
    }

    /**
     * testSetMethodReturnsSelf
     *
     * @return void
     */
    public function testSetMethodReturnsSelf(): void
    {
        $this->getMockTaxonomyExists('dn_kana_type', false);

        $instance = new TaxonomyFactory();
        $result = $instance->set('dn_kana_type', ['public' => true], ['dn_kana']);

        $this->assertSame($instance, $result);
    }

    /**
     * testHookAddsActionToInit
     *
     * @return void
     */
    public function testHookAddsActionToInit(): void
    {
        $this->getMockTaxonomyExists('dn_kana_type', false);

        $instance = new TaxonomyFactory();
        $instance->set('dn_kana_type', ['public' => true]);

        Functions\expect('add_action')
            ->once()
            ->with('init', [$instance, 'register'], 10)
            ->andReturnNull();

        $instance->hook();
    }

    /**
     * testRegisterCallsWordpressFunction
     *
     * @return void
     */
    public function testRegisterCallsWordpressFunction(): void
    {
        $taxonomy = 'dn_kana_type';
        $data = ['public' => true, 'label' => 'Type'];
        $postTypes = [];

        $this->getMockTaxonomyExists($taxonomy, false);

        $instance = new TaxonomyFactory();
        $instance->set($taxonomy, $data);

        Functions\expect('register_taxonomy')
            ->once()
            ->with($taxonomy, $postTypes, $data)
            ->andReturnNull();

        $instance->register();
    }

    /**
     * ----------------------------------------------------------
     * Vérification des données envoyées
     * ----------------------------------------------------------
     */

    /**
     * testSetMethodWithEmptyName
     *
     * @return void
     */
    public function testSetMethodWithEmptyName(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Le nom de la taxonomie doit avoir une longueur de 1 à 32 caractères.');

        $instance = new TaxonomyFactory();
        $instance->set('', ['public' => true], ['dn_kana']);

        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Le nom de la taxonomie doit avoir une longueur de 1 à 32 caractères.');

        $instance = new TaxonomyFactory();
        $instance->set('ezrohgeorhgoehgoehrgoerhgoehgoherogherogherhgeo', ['public' => true], ['dn_kana']);
    }

    /**
     * testSetMethodWithTooLengthName
     *
     * @return void
     */
    public function testSetMethodWithTooLengthName(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Le nom de la taxonomie doit avoir une longueur de 1 à 32 caractères.');

        $instance = new TaxonomyFactory();
        $instance->set('ezrohgeorhgoehgoehrgoerhgoehgoherogherogherhgeo', ['public' => true], ['dn_kana']);
    }

    /**
     * testSetMethodWhenTaxonomyNameExist
     *
     * @return void
     */
    public function testSetMethodWhenTaxonomyNameExist(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Le nom de la taxonomie category existe déjà.');

        $this->getMockTaxonomyExists('category', true);

        $instance = new TaxonomyFactory();
        $instance->set('category', ['public' => true], ['dn_kana']);
    }

    /**
     * testSetMethodWithEmptyData
     *
     * @return void
     */
    public function testSetMethodWithEmptyData(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Les données envoyées pour la taxonomie sont vides.');

        $this->getMockTaxonomyExists('dn_kana_type', false);

        $instance = new TaxonomyFactory();
        $instance->set('dn_kana_type', [], ['dn_kana']);
    }

    private function getMockTaxonomyExists(string $name, bool $result): void
    {
        Functions\expect('taxonomy_exists')
            ->once()
            ->with($name)
            ->andReturn($result)
        ;
    }
}

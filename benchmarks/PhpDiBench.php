<?php

namespace PhpBench\Benchmarks\Container;

use DI\ContainerBuilder;
use PhpBench\Benchmark\Metadata\Annotations\Groups;
use PhpBench\Benchmarks\Container\Acme\BicycleFactory;
use function DI\create;

/**
 * @Groups({"php-di"}, extend=true)
 */
class PhpDiBench extends ContainerBenchCase
{
    private $container;

    private function createOptimizedBuilder()
    {
        $builder = new ContainerBuilder();
        $builder->addDefinitions(array(
            'bicycle_factory' => create(BicycleFactory::class)
        ));

        return $builder;
    }

    public function initOptimized()
    {
        $builder = $this->createOptimizedBuilder();
        $container = $builder->build();
        $container->get('bicycle_factory');
        $this->container = $this->createOptimizedBuilder()->build();
    }

    public function initUnoptimized()
    {
        $builder = new ContainerBuilder();

        $this->container = $builder->build();
        $this->container->set('bicycle_factory', create(BicycleFactory::class));
    }

    public function initPrototype()
    {
        $this->initOptimized();
    }

    public function benchGetOptimized()
    {
        $this->container->get('bicycle_factory');
    }

    public function benchGetUnoptimized()
    {
        $this->container->get('bicycle_factory');
    }

    public function benchGetPrototype()
    {
        $this->container->make('bicycle_factory');
    }

    public function benchLifecycle()
    {
        $this->initOptimized();
        $this->container->get('bicycle_factory');
    }
}

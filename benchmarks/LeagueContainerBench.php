<?php

namespace PhpBench\Benchmarks\Container;

use League\Container\Container;
use PhpBench\Benchmark\Metadata\Annotations\Groups;
use PhpBench\Benchmark\Metadata\Annotations\Skip;
use PhpBench\Benchmarks\Container\Acme\BicycleFactory;

/**
 * @Groups({"league"}, extend=true)
 */
class LeagueContainerBench extends ContainerBenchCase
{
    private $container;

    public function initOptimized()
    {
        $this->initUnoptimized();
    }

    public function initUnoptimized()
    {
        $this->container = new Container();

        $this->container->add('bicycle_factory', BicycleFactory::class);
        $this->container->add('bicycle_factory_shared', BicycleFactory::class)->setShared(true);
    }

    /**
     * @Skip()
     */
    public function benchGetUnoptimized()
    {
    }

    public function benchGetOptimized()
    {
        $this->container->get('bicycle_factory_shared');
    }

    public function benchGetPrototype()
    {
        $this->container->get('bicycle_factory');
    }

    public function benchLifecycle()
    {
        $this->initUnoptimized();
        $this->container->get('bicycle_factory_shared');
    }
}


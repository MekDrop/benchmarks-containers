<?php

namespace PhpBench\Benchmarks\Container;

use DI\ContainerBuilder;
use DI\Cache\ArrayCache;
use League\Container\Container;
use PhpBench\Benchmarks\Container\Acme\BicycleFactory;

/**
 * @Groups({"league"}, extend=true)
 */
class LeagueContainerBench extends ContainerBenchCase
{
    private $container;

    public function initOptimized()
    {
        return $this->initUnoptimized();
    }

    public function initUnoptimized()
    {
        $this->container = new Container();

        $this->container->add('bicycle_factory', BicycleFactory::class);
        $this->container->share('bicycle_factory_shared', BicycleFactory::class);
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


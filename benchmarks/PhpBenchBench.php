<?php

namespace PhpBench\Benchmarks\Container;

use PhpBench\Benchmarks\Container\Acme\BicycleFactory;
use PhpBench\DependencyInjection\Container;

/**
 * @Groups({"phpbench"}, extend=true)
 */
class PhpBenchBench extends ContainerBenchCase
{
    private $container;

    public function initUnoptimized()
    {
        $container = new Container();
        $container->register('bicycle_factory', function ($c) {
            return new BicycleFactory;
        });
        $this->container = $container;
    }

    public function initOptimized()
    {
        $this->initUnoptimized();
    }

    public function benchLifecycle()
    {
        $this->initUnoptimized();
        $this->container->get('bicycle_factory');
    }

    public function benchGetOptimized()
    {
        $this->container->get('bicycle_factory');
    }

    /**
     * @Skip()
     */
    public function benchGetUnoptimized()
    {
    }

    /**
     * @Skip()
     */
    public function benchGetPrototype()
    {
    }
}

<?php

namespace PhpBench\Benchmarks\Container;

use PhpBench\Benchmarks\Container\Acme\BicycleFactory;
use Pimple\Container;

/**
 * @Groups({"pimple"}, extend=true)
 */
class PimpleDiBench extends ContainerBenchCase
{
    private $container;

    /**
     * @Skip()
     */
    public function benchGetUnoptimized()
    {
    }

    public function benchGetOptimized()
    {
        $this->container['bicycle_factory'];
    }

    public function benchGetPrototype()
    {
        $this->container['bicycle_factory_prototype'];
    }

    public function benchLifecycle()
    {
        $this->init();
        $this->container['bicycle_factory'];
    }

    public function initUnoptimized()
    {
        $this->init();
    }

    public function initOptimized()
    {
        $this->init();
    }

    public function init()
    {
        $container = new Container();
        $closure = function ($c) {
            return new BicycleFactory;
        };
        $prototype = $container->factory(function ($c) {
            return new BicycleFactory;
        });

        $container['bicycle_factory'] = $closure;
        $container['bicycle_factory_prototype'] = $prototype;
        $this->container = $container;
    }
}


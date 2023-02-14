<?php

namespace PhpBench\Benchmarks\Container;

use PhpBench\Benchmark\Metadata\Annotations\Groups;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Dumper\PhpDumper;
use PhpBench\Benchmarks\Container\Acme\BicycleFactory;

/**
 * @Groups({"symfony"}, extend=true)
 * @BeforeClassMethods({"clearCache", "warmup"})
 */
class SymfonyDiBench extends ContainerBenchCase
{
    private $container;

    public static function warmup()
    {
        $containerFile = self::getCacheDir() . '/container.php';

        $builder = self::getContainer();
        $dumper = new PhpDumper($builder);
        file_put_contents($containerFile, $dumper->dump());
    }

    public static function getContainer()
    {
        $builder = new ContainerBuilder();

        $builder
            ->register('bicycle_factory', BicycleFactory::class)
            ->setShared(true)
            ->setPublic(true)
        ;

        $builder
            ->register('bicycle_factory_shared', BicycleFactory::class)
            ->setPublic(true)
        ;

        $builder->compile();

        return $builder;
    }

    public function benchGetOptimized()
    {
        $this->container->get('bicycle_factory_shared');
    }

    public function benchGetUnoptimized()
    {
        $this->container->get('bicycle_factory_shared');
    }

    public function benchGetPrototype()
    {
        $this->container->get('bicycle_factory');
    }

    public function benchLifecycle()
    {
        $this->initOptimized();
        $this->container->get('bicycle_factory_shared');
    }

    public function initOptimized()
    {
        require_once(self::getCacheDir() . DIRECTORY_SEPARATOR . 'container.php');

        /** @noinspection PhpUndefinedClassInspection */
        $container = new \ProjectServiceContainer();

        $this->container = $container;
    }

    public function initUnoptimized()
    {
        $this->container = self::getContainer();
    }
}

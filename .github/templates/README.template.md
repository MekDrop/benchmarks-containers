# PHP Container Benchmarking Suite

[![Build Status](https://travis-ci.org/phpbench/benchmarks-containers.svg)](https://travis-ci.org/phpbench/benchmarks-containers)

This benchmarking suite compares PHP Dependency Injection Containers. Its sort
of an example project for [PHPBench](https://github.com/phpbench/phpbench).

It is intended to be a base for developing a standard benchmarking suite for
all of the PHP containers out there.

Including:

- [PHP-DI](https://github.com/PHP-DI/PHP-DI).
- [Symfony Dependency Injection](https://github.com/symfony/DependencyInjection).
- [Pimple](https://github.com/silexphp/Pimple).
- [PHPBench Container](https://github.com/phpbench/phpbench).
- [Illuminate (Laravel) Container](https://github.com/illuminate/container)
- [Php League Container](http://container.thephpleague.com/)
- [Zend Service Manager](https://github.com/zendframework/zend-servicemanager)
- [Aura DI](https://github.com/auraphp/aura.di)

Note that PHPBench Container is not a "real" container, but a minimal
ad-hoc call-back based container used by PHPBench itself.

## Disclaimer

We take no responsibility for the accuracy of these benchmarks. If you want to
be sure of the results please clone this repository, look at the code, and run
the benchmarks yourself.

If you are a container maintainer and you notice that the benchmarks are not
fair, then please make a pull request.

The benchmarks do not cover all contingencies, infact they are currently quite
limited. Please feel free to make pull requests as required.

## Run the Benchmarks

````bash
$ composer install
$ ./vendor/bin/phpbench run --report=all
````

or

```bash
$ ./vendor/bin/phpbench run --store
$ ./vendor/bin/phpbench show latest --report=all
```

For the HTML report:

```
$ ./vendor/bin/phpbench show latest --report=all --output=container_html
```

## Versions

```
{{ .packages }}
```

## Latest results
-------

- All containers are expected to be optimized except in the `unoptimized
  test`.

Subjects (all executed 1000 times):

- `GetOptimizedNode`: Return a shared service (expected cache effect).
- `GetUnoptimized`: Return a shared service without optimization (i.e. no
  dumping of the container, etc).
- `GetPrototype`: Return a new instance of the service.
- `Lifecycle`: Instantiate the container and return a shared service.

## Suite #{{ .commit }} {{ .time }}

50 iterations, 1000 revolutions, 5 warmup revolutions, stdev < 3%

{{ .results }}
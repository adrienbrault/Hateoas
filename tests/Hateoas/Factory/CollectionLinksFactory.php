<?php

namespace tests\Hateoas\Factory;

use tests\TestCase;
use Hateoas\Factory\CollectionLinksFactory as TestedCollectionLinksFactory;

class CollectionLinksFactory extends TestCase
{
    public function testCreate()
    {
        $routeFactory = new \mock\Hateoas\Factory\RouteFactoryInterface();
        $routeFactory->getMockController()->create = function ($route, $parameters) {
            return '/users?p='.$parameters['p'];
        };
        $collectionLinksFactory = new TestedCollectionLinksFactory($routeFactory, 'p');

        $links = $collectionLinksFactory->create($route = 'user_all', 4, 6, $absolute = true);

        $this
            ->array($links)
                ->hasSize(5)
            ->object($link = $links[0])
                ->isInstanceOf('Hateoas\Model\Link')
                ->and
                    ->string($link->getRel())
                        ->isEqualTo('self')
                    ->string($link->getHref())
                        ->isEqualTo('/users?p=4')
            ->object($link = $links[1])
                ->isInstanceOf('Hateoas\Model\Link')
                ->and
                    ->string($link->getRel())
                        ->isEqualTo('previous')
                    ->string($link->getHref())
                        ->isEqualTo('/users?p=3')
            ->object($link = $links[2])
                ->isInstanceOf('Hateoas\Model\Link')
                ->and
                    ->string($link->getRel())
                        ->isEqualTo('next')
                    ->string($link->getHref())
                        ->isEqualTo('/users?p=5')
            ->object($link = $links[3])
                ->isInstanceOf('Hateoas\Model\Link')
                ->and
                    ->string($link->getRel())
                        ->isEqualTo('first')
                    ->string($link->getHref())
                        ->isEqualTo('/users?p=1')
            ->object($link = $links[4])
                ->isInstanceOf('Hateoas\Model\Link')
                ->and
                    ->string($link->getRel())
                        ->isEqualTo('last')
                    ->string($link->getHref())
                        ->isEqualTo('/users?p=6')
            ->mock($routeFactory)
                ->call('create')
                    ->withArguments($route, array('p' => 1), $absolute)->once()
                    ->withArguments($route, array('p' => 3), $absolute)->once()
                    ->withArguments($route, array('p' => 4), $absolute)->once()
                    ->withArguments($route, array('p' => 5), $absolute)->once()
                    ->withArguments($route, array('p' => 6), $absolute)->once()
        ;
    }

    public function testCreatePage1Pages1()
    {
        $routeFactory = new \mock\Hateoas\Factory\RouteFactoryInterface();
        $routeFactory->getMockController()->create = function ($route, $parameters) {
            return '/users?p='.$parameters['p'];
        };
        $collectionLinksFactory = new TestedCollectionLinksFactory($routeFactory, 'p');

        $links = $collectionLinksFactory->create('user_all', 1, 1);

        $this->array($links)
                ->hasSize(3)
            ->object($link = $links[0])
                ->isInstanceOf('Hateoas\Model\Link')
                ->and
                    ->string($link->getRel())
                        ->isEqualTo('self')
                    ->string($link->getHref())
                        ->isEqualTo('/users?p=1')
            ->object($link = $links[1])
                ->isInstanceOf('Hateoas\Model\Link')
                ->and
                    ->string($link->getRel())
                        ->isEqualTo('first')
                    ->string($link->getHref())
                        ->isEqualTo('/users?p=1')
            ->object($link = $links[2])
                ->isInstanceOf('Hateoas\Model\Link')
                ->and
                    ->string($link->getRel())
                        ->isEqualTo('last')
                    ->string($link->getHref())
                        ->isEqualTo('/users?p=1')
        ;
    }

    public function testCreatePage0Pages0()
    {
        $routeFactory = new \mock\Hateoas\Factory\RouteFactoryInterface();
        $routeFactory->getMockController()->create = function ($route, $parameters) {
            return '/users?p='.$parameters['p'];
        };
        $collectionLinksFactory = new TestedCollectionLinksFactory($routeFactory, 'p');

        $links = $collectionLinksFactory->create('user_all', 0, 0);

        $this->array($links)
                ->hasSize(1)
            ->object($link = $links[0])
                ->isInstanceOf('Hateoas\Model\Link')
                ->and
                    ->string($link->getRel())
                        ->isEqualTo('self')
                    ->string($link->getHref())
                        ->isEqualTo('/users?p=0')
        ;
    }
}

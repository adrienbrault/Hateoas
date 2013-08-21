<?php

namespace tests\Hateoas\Factory;

use Hateoas\Configuration\Collection;
use Hateoas\Model\Link;
use tests\TestCase;
use Hateoas\Factory\CollectionResourceFactory as TestedCollectionResourceFactory;

class CollectionResourceFactory extends TestCase
{
    public function testCreate()
    {
        $links = array(
            new Link('foo', '/bar'),
        );

        $this->mockGenerator->orphanize('__construct');
        $collectionLinksFactory = new \mock\Hateoas\Factory\CollectionLinksFactory();
        $collectionLinksFactory->getMockController()->create = function () use ($links) {
            return $links;
        };

        $collectionResourceFactory = new TestedCollectionResourceFactory($collectionLinksFactory);

        $items = array(new \StdClass());
        $collection = new Collection(
            $route = 'user_all', $rel = 'users', $xmlRootName = 'users', $xmlElementName = 'user'
        );
        $page = 4;
        $totalPages = 13;

        $resource = $collectionResourceFactory->create($items, $collection, $page, $totalPages);

        $this
            ->object($resource)
                ->isInstanceOf('Hateoas\Model\Resource')
                ->variable($resource->getData())
                    ->isEqualTo(array(
                        'page' => $page,
                        'totalPages' => $totalPages,
                    ))
                ->array($embeds = $resource->getEmbeds())
                    ->size->isEqualTo(1)
                    ->object($embed = $embeds[0])
                        ->isInstanceOf('Hateoas\Model\Embed')
                        ->variable($embed->getRel())
                            ->isEqualTo($rel)
                        ->variable($embed->getXmlElementName())
                            ->isEqualTo($xmlElementName)
                        ->variable($embed->getData())
                            ->isEqualTo($items)
                ->array($resource->getLinks())
                    ->isEqualTo($links)
                ->variable($resource->getXmlRootName())
                    ->isEqualTo('users')
            ->mock($collectionLinksFactory)
                ->call('create')
                    ->once()->withArguments($route, $page, $totalPages)
        ;
    }
}

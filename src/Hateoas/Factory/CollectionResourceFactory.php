<?php

namespace Hateoas\Factory;

use Hateoas\Configuration\Collection;
use Hateoas\Model\Embed;
use Hateoas\Model\Resource;

/**
 * @author Adrien Brault <adrien.brault@gmail.com>
 */
class CollectionResourceFactory
{
    /**
     * @var CollectionLinksFactory
     */
    private $collectionLinksFactory;

    public function __construct(CollectionLinksFactory $collectionLinksFactory)
    {
        $this->collectionLinksFactory = $collectionLinksFactory;
    }

    /**
     * @param  mixed      $items
     * @param  Collection $collectionDefinition
     * @param  int        $page
     * @param  int        $totalPages
     * @return Resource
     */
    public function create($items, Collection $collectionDefinition, $page, $totalPages)
    {
        $data = array(
            'page' => $page,
            'totalPages' => $totalPages,
        );

        $links = $this->collectionLinksFactory->create(
            $collectionDefinition->getRoute(),
            $page,
            $totalPages
        );

        $embeds = array(
            new Embed($collectionDefinition->getRel(), $items, $collectionDefinition->getXmlElementName()),
        );

        return new Resource($data, $links, $embeds, $collectionDefinition->getXmlRootName());
    }
}

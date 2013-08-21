<?php

namespace Hateoas\Factory;

use Hateoas\Model\Link;

/**
 * @author Adrien Brault <adrien.brault@gmail.com>
 */
class CollectionLinksFactory
{
    /**
     * @var RouteFactoryInterface
     */
    private $routeFactory;

    /**
     * @var string
     */
    private $routePageParameterName;

    public function __construct(RouteFactoryInterface $routeFactory, $routePageParameterName = 'page')
    {
        $this->routeFactory = $routeFactory;
        $this->routePageParameterName = $routePageParameterName;
    }

    public function create($route, $page, $totalPages, $absolute = false)
    {
        $links = array();
        $links[] = new Link('self', $this->routeFactory->create($route, array(
            $this->routePageParameterName => $page
        ), $absolute));

        if ($totalPages > 0) {
            if ($page > 1) {
                $links[] = new Link('previous', $this->routeFactory->create($route, array(
                    $this->routePageParameterName => ($page - 1)
                ), $absolute));
            }

            if ($page < $totalPages) {
                $links[] = new Link('next', $this->routeFactory->create($route, array(
                    $this->routePageParameterName => ($page + 1)
                ), $absolute));
            }

            $links[] = new Link('first', $this->routeFactory->create($route, array(
                $this->routePageParameterName => 1
            ), $absolute));
            $links[] = new Link('last', $this->routeFactory->create($route, array(
                $this->routePageParameterName => $totalPages
            ), $absolute));
        }

        return $links;
    }
}

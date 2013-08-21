<?php

namespace Hateoas\Configuration;

/**
 * @author Adrien Brault <adrien.brault@gmail.com>
 */
class Collection
{
    /**
     * @var string
     */
    private $route;

    /**
     * @var string
     */
    private $rel;

    /**
     * @var null|string
     */
    private $xmlRootName;

    /**
     * @var null|string
     */
    private $xmlElementName;

    public function __construct($route, $rel, $xmlRootName = null, $xmlElementName = null)
    {
        $this->route = $route;
        $this->rel = $rel;
        $this->xmlRootName = $xmlRootName;
        $this->xmlElementName = $xmlElementName;
    }

    /**
     * @return string
     */
    public function getRoute()
    {
        return $this->route;
    }

    /**
     * @return string
     */
    public function getRel()
    {
        return $this->rel;
    }

    /**
     * @return null|string
     */
    public function getXmlRootName()
    {
        return $this->xmlRootName;
    }

    /**
     * @return null|string
     */
    public function getXmlElementName()
    {
        return $this->xmlElementName;
    }
}

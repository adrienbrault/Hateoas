<?php

namespace Hateoas;

use Hateoas\Configuration\RelationsRepository;
use Hateoas\Factory\CollectionResourceFactory;
use Hateoas\Handler\HandlerManager;
use JMS\Serializer\DeserializationContext;
use JMS\Serializer\SerializationContext;
use JMS\Serializer\SerializerInterface;

/**
 * @author Adrien Brault <adrien.brault@gmail.com>
 */
class Hateoas implements SerializerInterface
{
    /**
     * @var SerializerInterface
     */
    private $serializer;

    /**
     * @var RelationsRepository
     */
    private $relationsRepository;

    /**
     * @var HandlerManager
     */
    private $handlerManager;

    /**
     * @var CollectionResourceFactory
     */
    private $collectionResourceFactory;

    /**
     * @param SerializerInterface       $serializer
     * @param RelationsRepository       $RelationsRepository
     * @param HandlerManager            $handlerManager
     * @param CollectionResourceFactory $collectionResourceFactory
     */
    public function __construct(
        SerializerInterface $serializer,
        RelationsRepository $relationsRepository,
        HandlerManager $handlerManager,
        CollectionResourceFactory $collectionResourceFactory = null
    )
    {
        $this->serializer                = $serializer;
        $this->relationsRepository       = $relationsRepository;
        $this->handlerManager            = $handlerManager;
        $this->collectionResourceFactory = $collectionResourceFactory;
    }

    /**
     * {@inheritdoc}
     */
    public function serialize($data, $format, SerializationContext $context = null)
    {
        return $this->serializer->serialize($data, $format, $context);
    }

    /**
     * {@inheritdoc}
     */
    public function deserialize($data, $type, $format, DeserializationContext $context = null)
    {
        return $this->serializer->deserialize($data, $type, $format, $context);
    }

    /**
     * @return HandlerManager
     */
    public function getHandlerManager()
    {
        return $this->handlerManager;
    }

    /**
     * @return RelationsRepository
     */
    public function getrelationsRepository()
    {
        return $this->relationsRepository;
    }

    /**
     * @return SerializerInterface
     */
    public function getSerializer()
    {
        return $this->serializer;
    }

    /**
     * @return CollectionResourceFactory
     */
    public function getCollectionResourceFactory()
    {
        return $this->collectionResourceFactory;
    }
}

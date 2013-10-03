<?php

namespace Hateoas\Tests\Configuration;

use Hateoas\Tests\TestCase;
use Hateoas\Configuration\Relation as TestedRelation;

class RelationTest extends TestCase
{
    public function testConstructor()
    {
        $relation = new TestedRelation('self', 'user_get');

        $this
            ->object($relation)
                ->isInstanceOf('Hateoas\Configuration\Relation')
            ->string($relation->getName())
                ->isEqualTo('self')
            ->string($relation->getHref())
                ->isEqualTo('user_get')
            ->array($relation->getAttributes())
                ->isEmpty()
        ;
    }
}

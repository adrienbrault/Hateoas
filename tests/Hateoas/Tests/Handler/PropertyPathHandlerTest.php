<?php

namespace Hateoas\Tests\Handler;

use Hateoas\Tests\TestCase;
use Hateoas\Handler\PropertyPathHandler as TestedPropertyPathHandler;

class PropertyPathHandlerTest extends TestCase
{
    public function testTransform()
    {
        $handler = new TestedPropertyPathHandler();
        $data = (object) array(
            'id' => 42,
        );

        $this
            ->integer($handler->transform('id', $data))
                ->isEqualTo(42)
        ;
    }
}

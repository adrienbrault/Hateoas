<?php

namespace Hateoas\Tests\Configuration\Metadata\Driver;

use Doctrine\Common\Annotations\AnnotationReader;
use Hateoas$1AnnotationDriver as AnnotationDriver;

class AnnotationDriverTest extends AbstractDriverTest
{
    public function createDriver()
    {
        return new TestedAnnotationDriver(new AnnotationReader());
    }
}

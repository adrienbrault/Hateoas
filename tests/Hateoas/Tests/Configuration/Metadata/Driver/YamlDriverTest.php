<?php

namespace Hateoas\Tests\Configuration\Metadata\Driver;

use Metadata\Driver\FileLocator;
use Hateoas\Configuration\Metadata\Driver\YamlDriver as TestedYamlDriver;

class YamlDriverTest extends AbstractDriverTest
{
    public function createDriver()
    {
        return new TestedYamlDriver(new FileLocator(array(
            'tests\fixtures' => $this->rootPath() . '/fixtures/config',
        )));
    }
}

<?php

namespace Hateoas\Tests\Handler;

use Hateoas\Tests\TestCase;
use Hateoas\Handler\HandlerManager as TestedHandlerManager;

class HandlerManagerTest extends TestCase
{
    public function testStringTransform()
    {
        $handlerManager = new TestedHandlerManager();

        $this
            ->string($handlerManager->transform('hello', null))
                ->isEqualTo('hello')
        ;
    }

    public function testInvalidValueTransform()
    {
        $handlerManager = new TestedHandlerManager();

        $this
            ->exception(function () use ($handlerManager) {
                $handlerManager->transform('@', null);
            })
                ->isInstanceOf('InvalidArgumentException')
                ->hasMessage('Cannot parse "@".')
        ;
    }

    public function testMissingHandlerTransform()
    {
        $handlerManager = new TestedHandlerManager();

        $this
            ->exception(function () use ($handlerManager) {
                $handlerManager->transform('@this.id', null);
            })
                ->isInstanceOf('InvalidArgumentException')
                ->hasMessage('Handler "this" does not exist.')
        ;
    }

    public function testTransform()
    {
        $handler = new \mock\Hateoas\Handler\HandlerInterface();
        $handler->getMockController()->transform = function () {
            return '42';
        };
        $data = new \StdClass();

        $handlerManager = new TestedHandlerManager(array(
            'this' => $handler,
        ));

        $this
            ->string($handlerManager->transform('@this.id', $data))
                ->isEqualTo('42')
            ->mock($handler)
                ->call('transform')
                    ->withArguments('id', $data)
                    ->once()
        ;
    }

    public function testArrayTransform()
    {
        $handler = new \mock\Hateoas\Handler\HandlerInterface();
        $handler->getMockController()->transform = function ($value) {
            return '' . strlen($value);
        };
        $data = new \StdClass();

        $handlerManager = new TestedHandlerManager(array(
            'this' => $handler,
        ));

        $array = array(
            '@this.a' => '@this.aa',
            'hello' => '@this.aaa',
        );

        $this
            ->array($handlerManager->transformArray($array, $data))
                ->isEqualTo(array(
                    '1' => '2',
                    'hello' => '3',
                ))
            ->mock($handler)
                ->call('transform')
                    ->thrice()
        ;
    }
}

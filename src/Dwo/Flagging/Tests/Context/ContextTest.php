<?php

namespace Dwo\Flagging\Tests\Model;

use Dwo\Flagging\Context\Context;

class ContextTest extends \PHPUnit_Framework_TestCase
{
    public function testConstructDefault()
    {
        $context = new Context();

        self::assertNull($context->getName());
        self::assertInternalType('array', $context->getParams());
        self::assertCount(0, $context->getParams());
        self::assertNull($context->getConfig());
        self::assertInstanceOf('Dwo\Flagging\Context\ResultCache', $context->getResultCache());
    }

    public function testConstruct()
    {
        $context = new Context(['foo'], 'bar');

        self::assertEquals('bar', $context->getName());
        self::assertEquals(['foo'], $context->getParams());
        self::assertNull($context->getConfig());
    }

    public function testConfig()
    {
        $context = new Context();
        $context->setConfig(['foo']);

        self::assertEquals(['foo'], $context->getConfig());
    }
}
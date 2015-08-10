<?php

namespace Dwo\Flagging\Tests\Model;

use Dwo\Flagging\Model\FilterBag;
use Dwo\Flagging\Model\Value;

class ValueTest extends \PHPUnit_Framework_TestCase
{
    public function testConstructDefault()
    {
        $value = new Value('foo');

        self::assertEquals('foo', $value->getValue());
        self::assertInstanceOf('Dwo\Flagging\Model\FilterBagInterface', $value->getFilter());
        self::assertFalse($value->isFeature());
    }

    public function testConstruct()
    {
        $filter = new FilterBag(array('foo'));

        $value = new Value('foo', $filter, true);

        self::assertEquals($filter, $value->getFilter());
        self::assertTrue($value->isFeature());
    }
}
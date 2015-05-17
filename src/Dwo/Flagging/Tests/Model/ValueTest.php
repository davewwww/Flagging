<?php

namespace Dwo\Flagging\Tests\Model;

use Dwo\Flagging\Model\Feature;
use Dwo\Flagging\Model\FilterBag;
use Dwo\Flagging\Model\Value;
use Dwo\Flagging\Model\ValueBag;

class ValueTest extends \PHPUnit_Framework_TestCase
{
    public function testConstructDefault()
    {
        $value = new Value('foo');

        self::assertEquals('foo', $value->getValue());
        self::assertInstanceOf('Dwo\Flagging\Model\FilterBagInterface', $value->getFilter());
    }

    public function testConstruct()
    {
        $filter = new FilterBag(array('foo'));

        $value = new Value('foo', $filter);

        self::assertEquals($filter, $value->getFilter());
    }
}
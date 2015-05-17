<?php

namespace Dwo\Flagging\Tests\Model;

use Dwo\Flagging\Model\Filter;

class FilterTest extends \PHPUnit_Framework_TestCase
{
    public function testConstructDefault()
    {
        $filter = new Filter('foo');

        self::assertEquals('foo', $filter->getName());
        self::assertNull($filter->getParameter());
    }

    public function testConstruct()
    {
        $filter = new Filter('foo', array('bar'));

        self::assertEquals('foo', $filter->getName());
        self::assertEquals(array('bar'), $filter->getParameter());
    }

    public function testToString()
    {
        $filter = new Filter('foo', array('bar'));

        self::assertEquals('foo_["bar"]', (string) $filter);
    }
}
<?php

namespace Dwo\Flagging\Tests\Model;

use Dwo\Flagging\Model\FilterBag;
use Dwo\Flagging\Model\FilterGroup;

class FilterBagTest extends \PHPUnit_Framework_TestCase
{
    public function testConstructDefault()
    {
        $filterBag = new FilterBag();

        self::assertCount(0, $filterBag->getFilterGroups());
        self::assertFalse($filterBag->hasFilter());
    }

    public function testConstruct()
    {
        $filterBag = new FilterBag($filterGroup = array(new FilterGroup(array('foo'))));

        self::assertCount(1, $filterBag->getFilterGroups());
        self::assertTrue($filterBag->hasFilter());
        self::assertEquals($filterGroup, $filterBag->getFilterGroups());
    }
}
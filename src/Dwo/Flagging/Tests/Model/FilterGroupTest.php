<?php

namespace Dwo\Flagging\Tests\Model;

use Dwo\Flagging\Model\FilterBag;
use Dwo\Flagging\Model\FilterGroup;

class FilterGroupTest extends \PHPUnit_Framework_TestCase
{
    public function testConstructDefault()
    {
        $filterGroup = new FilterGroup();

        self::assertCount(0, $filterGroup->getFilters());
    }

    public function testConstruct()
    {
        $filterGroup = new FilterGroup($filters = array('foo'));

        self::assertCount(1, $filterGroup->getFilters());
        self::assertEquals($filters, $filterGroup->getFilters());
    }
}
<?php

namespace Dwo\Flagging\Tests\Model;

use Dwo\Flagging\Model\ValueBag;

class ValueBagTest extends \PHPUnit_Framework_TestCase
{
    public function testConstructDefault()
    {
        $valueBag = new ValueBag();

        self::assertCount(0, $valueBag->getValues());
    }

    public function testConstruct()
    {
        $valueBag = new ValueBag($values = array('foo'));

        self::assertCount(1, $valueBag->getValues());
        self::assertEquals($values, $valueBag->getValues());
    }
}
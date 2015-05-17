<?php

namespace Dwo\Flagging\Tests\Model;

use Dwo\Flagging\Model\Feature;
use Dwo\Flagging\Model\FilterBag;
use Dwo\Flagging\Model\Value;
use Dwo\Flagging\Model\ValueBag;

class FeatureTest extends \PHPUnit_Framework_TestCase
{
    public function testConstructDefault()
    {
        $feature = new Feature('foo');

        self::assertEquals('foo', $feature->getName());
        self::assertInstanceOf('Dwo\Flagging\Model\FilterBagInterface', $feature->getFilter());
        self::assertInstanceOf('Dwo\Flagging\Model\FilterBagInterface', $feature->getBreaker());
        self::assertInstanceOf('Dwo\Flagging\Model\ValueBagInterface', $feature->getValue());
        self::assertTrue($feature->isEnabled());
    }

    public function testConstruct()
    {
        $filter = new FilterBag(array('foo'));
        $breaker = new FilterBag(array('bar'));
        $values = new ValueBag(array(new Value('lorem')));

        $feature = new Feature('foo', $filter, $breaker, $values);

        self::assertEquals($filter, $feature->getFilter());
        self::assertNotEquals($filter, $feature->getBreaker());
        self::assertEquals($breaker, $feature->getBreaker());
        self::assertNotEquals($breaker, $feature->getFilter());
        self::assertEquals($values, $feature->getValue());
    }

    public function testDisabledAndEnabled()
    {
        $feature = new Feature('foo');

        $feature->setEnabled(false);
        self::assertFalse($feature->isEnabled());

        $feature->setEnabled(true);
        self::assertTrue($feature->isEnabled());
    }
}
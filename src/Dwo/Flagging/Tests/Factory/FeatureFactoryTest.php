<?php

namespace Dwo\Flagging\Tests\Factory;

use Dwo\Flagging\Factory\FeatureFactory;
use Dwo\Flagging\Model\FilterInterface;
use Dwo\Flagging\Model\Value;
use Dwo\Flagging\Model\ValueInterface;

class FeatureFactoryTest extends \PHPUnit_Framework_TestCase
{
    public function testEmptyFeature()
    {
        $feature = FeatureFactory::buildFeature('foo');
        self::assertTrue($feature->isEnabled());

        self::assertInstanceOf('Dwo\Flagging\Model\FeatureInterface', $feature);
        self::assertEquals('foo', $feature->getName());
    }

    public function testFilters()
    {
        $data = array(
            'filters' => array(
                array('foo' => 'bar')
            )
        );
        $feature = FeatureFactory::buildFeature('foo', $data);
        self::assertCount(1, $filterGroups = $feature->getFilter()->getFilterGroups());

        /** @var FilterInterface $filter */
        $filter = current($filterGroups)->getFilters()[0];
        self::assertEquals('foo', $filter->getName());
        self::assertEquals('bar', $filter->getParameter());
    }

    public function testBreaker()
    {
        $data = array(
            'breaker' => array(
                array('foo' => 'bar')
            )
        );
        $feature = FeatureFactory::buildFeature('foo', $data);
        self::assertFalse($filterGroups = $feature->getFilter()->hasFilter());
        self::assertTrue($filterGroups = $feature->getBreaker()->hasFilter());
        self::assertCount(1, $filterGroups = $feature->getBreaker()->getFilterGroups());

        /** @var FilterInterface $filter */
        $filter = current($filterGroups)->getFilters()[0];
        self::assertEquals('foo', $filter->getName());
        self::assertEquals('bar', $filter->getParameter());
    }

    public function testValue()
    {
        $data = array(
            'values' => array(
                array('value' => 'foo')
            )
        );
        $feature = FeatureFactory::buildFeature('foo', $data);;
        self::assertCount(1, $values = $feature->getValue()->getValues());

        /** @var ValueInterface $value */
        $value = current($values);
        self::assertEquals('foo', $value->getValue());
    }

    public function testValueWithFilter()
    {
        $data = array(
            'values' => array(
                array(
                    'value'   => 'foo',
                    'filters' => array(
                        array('foo' => 'bar')
                    )
                )
            )
        );
        $feature = FeatureFactory::buildFeature('foo', $data);;
        self::assertCount(1, $values = $feature->getValue()->getValues());

        /** @var Value $value */
        $value = current($values);
        self::assertTrue($value->getFilter()->hasFilter());

        self::assertCount(1, $filterGroups = $value->getFilter()->getFilterGroups());

        /** @var FilterInterface $filter */
        $filter = current($filterGroups)->getFilters()[0];
        self::assertEquals('foo', $filter->getName());
        self::assertEquals('bar', $filter->getParameter());
    }

    public function testEnabledTrue()
    {
        $data = array(
            'enabled' => true
        );
        $feature = FeatureFactory::buildFeature('foo', $data);
        self::assertTrue($feature->isEnabled());
    }

    public function testEnabledFalse()
    {
        $data = array(
            'enabled' => false
        );
        $feature = FeatureFactory::buildFeature('foo', $data);
        self::assertFalse($feature->isEnabled());
    }
}
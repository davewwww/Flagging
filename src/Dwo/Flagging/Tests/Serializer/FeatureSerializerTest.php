<?php

namespace Dwo\Flagging\Tests\Factory;

use Dwo\Flagging\Factory\FeatureFactory;
use Dwo\Flagging\Serializer\FeatureSerializer;

class FeatureSerializerTest extends \PHPUnit_Framework_TestCase
{
    public function testAll()
    {
        $data = array(
            'filters' => array(
                array(
                    'foo'    => 'bar',
                    'foobar' => [1, 2],
                ),
                array(
                    'bar' => 'foo',
                ),
            ),
            'breaker' => array(
                array('foo' => 'bar')
            ),
            'values'  => array(
                array(
                    'value'   => ['foo', 'bar'],
                    'filters' => array(
                        array('foo' => 'bar')
                    )
                ),
                array(
                    'value' => ['foobar'],
                )
            ),
            'enabled' => true,
        );

        $feature = FeatureFactory::buildFeature('foo', $data);
        $serialized = FeatureSerializer::serialize($feature);

        unset($data['enabled']);
        self::assertEquals($serialized, $data);
    }

    public function testDisabled()
    {
        $data = array(
            'enabled' => false,
        );

        $feature = FeatureFactory::buildFeature('foo', $data);

        $serialized = FeatureSerializer::serialize($feature);

        self::assertEquals($serialized, $data);
    }

    public function testEmpty()
    {
        $data = array();

        $feature = FeatureFactory::buildFeature('foo', $data);

        $serialized = FeatureSerializer::serialize($feature);

        self::assertEquals($serialized, $data);
    }
}
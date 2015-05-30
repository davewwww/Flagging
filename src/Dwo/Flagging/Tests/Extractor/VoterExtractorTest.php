<?php

namespace Dwo\Flagging\Tests\Extractor;

use Dwo\Flagging\Extractor\VoterExtractor;
use Dwo\Flagging\Factory\FeatureFactory;

class VoterExtractorTest extends \PHPUnit_Framework_TestCase
{
    public function test()
    {
        $value = array(
            'filters' => array(
                array('foo1' => [], 'foo2' => []),
                array('foo3' => [])
            ),
            'breaker' => array(
                array('foo2' => []),
                array('foo3' => [], 'foo4' => [])
            ),
            'values'  => array(
                array(
                    'filters' => array(
                        array('foo1' => [], 'foo2' => []),
                        array('foo4' => [])
                    ),
                    'value' => null
                )
            )
        );

        $feature = FeatureFactory::buildFeature('foo',$value);

        $voters = VoterExtractor::extract($feature);

        self::assertEquals(array('foo1', 'foo2', 'foo3', 'foo4'), $voters);
    }

    public function testFromArray()
    {
        $value = array(
            'filters' => array(
                array('foo1' => [])
            ),
            'breaker' => array(
                array('foo2' => [])
            ),
            'values'  => array(
                array(
                    'filters' => array(
                        array('foo3' => [])
                    )
                )
            )
        );

        $voters = VoterExtractor::extractFromArray($value);

        self::assertEquals(array('foo1', 'foo2', 'foo3'), $voters);
    }
}
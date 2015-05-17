<?php

namespace Dwo\Flagging\Tests\Functional;

use Dwo\Flagging\Context\Context;
use Dwo\Flagging\Factory\FeatureFactory;
use Dwo\Flagging\FeatureDecider;
use Dwo\Flagging\Model\FeatureInterface;
use Dwo\Flagging\Tests\Fixtures\FeatureManager;
use Dwo\Flagging\Tests\Fixtures\NameVoter;
use Dwo\Flagging\Tests\Fixtures\VoterManager;
use Dwo\Flagging\Voter\EntriesAndVoter;
use Dwo\Flagging\Voter\FeatureVoter;
use Dwo\Flagging\Voter\FilterGroupsVoter;
use Dwo\Flagging\Voter\FilterVoter;

class FeatureDeciderTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider provider
     */
    public function test($result, $feature, $name)
    {
        $decider = $this->getFeatureDecider();

        $context = new Context(array('name' => $name));

        self::assertEquals($result, $decider->decide($feature, $context));
    }

    public function provider()
    {
        return array(
            array(true, 'name_foo', 'foo'),
            array(false, 'name_foo', 'bar'),

            array(true, 'name_foo_or_bar', 'foo'),
            array(true, 'name_foo_or_bar', 'bar'),
            array(false, 'name_foo_or_bar', 'lorem'),

            array(true, 'name_no_foo_or_bar', 'lorem'),
            array(true, 'name_no_foo_or_bar', 'ipsum'),
            array(false, 'name_no_foo_or_bar', 'foo'),
            array(false, 'name_no_foo_or_bar', 'bar'),
            array(false, 'name_no_foo_or_bar', 'foobar'),
        );
    }

    /**
     * @return FeatureDecider
     */
    protected function getFeatureDecider()
    {
        $featureManager = new FeatureManager($this->getFeatures());
        $voterManager = new VoterManager(
            array(
                'name_voter' => new NameVoter()
            )
        );

        $filterVoter = new FilterVoter($voterManager);
        $entriesAndVoter = new EntriesAndVoter($filterVoter);
        $filterGroupsVoter = new FilterGroupsVoter($entriesAndVoter);
        $featureVoter = new FeatureVoter($filterGroupsVoter);

        return new FeatureDecider($featureManager, $featureVoter);
    }

    /**
     * @return FeatureInterface[]
     */
    protected function getFeatures()
    {
        $featureData = array(
            'name_foo'           => array(
                'filters' => array(
                    array('name_voter' => ['foo'])
                )
            ),
            'name_foo_or_bar'    => array(
                'filters' => array(
                    array('name_voter' => ['foo', 'bar'])
                )
            ),
            'name_no_foo_or_bar' => array(
                'breaker' => array(
                    array('name_voter' => ['foo', 'bar'])
                ),
                'filters' => array(
                    array('name_voter' => ['!foobar'])
                )
            )
        );

        $features = [];
        foreach ($featureData as $name => $data) {
            $features[$name] = FeatureFactory::buildFeature($name, $data);
        }

        return $features;
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|FeatureVoter
     */
    protected function mockVoter()
    {
        return $this->getMockBuilder('Dwo\Flagging\Voter\FeatureVoter')
            ->disableOriginalConstructor()
            ->getMock();
    }

}
<?php

namespace Dwo\Flagging\Tests;

use Dwo\Flagging\Context\Context;
use Dwo\Flagging\Model\Feature;
use Dwo\Flagging\Model\FeatureManagerInterface;
use Dwo\Flagging\Model\Value;
use Dwo\Flagging\Model\ValueBag;
use Dwo\Flagging\ValueDecider;
use Dwo\Flagging\Voter\FeatureVoter;

class ValueDeciderTest extends \PHPUnit_Framework_TestCase
{
    public function testDecideValueOk()
    {
        $manager = $this->mockManager();
        $featureVoter = $this->mockFeatureVoter();
        $filterBagVoter = $this->mockFilterBagVoter();

        $context = new Context();

        $feature = new Feature('feature', null, null, new ValueBag(array(new Value('foo'))));

        $featureVoter->expects(self::once())
            ->method('vote')
            ->with($feature, $context)
            ->willReturn(true);

        $filterBagVoter->expects(self::once())
            ->method('vote')
            ->with(self::isInstanceOf('Dwo\Flagging\Model\FilterBagInterface'), $context)
            ->willReturn(true);

        $decider = new ValueDecider($manager, $featureVoter, $filterBagVoter);
        $result = $decider->decideFeature($feature, $context);

        self::assertEquals('foo', $result);
    }

    public function testDecideValueFalse()
    {
        $manager = $this->mockManager();
        $featureVoter = $this->mockFeatureVoter();
        $filterBagVoter = $this->mockFilterBagVoter();

        $context = new Context();

        $feature = new Feature('feature', null, null, new ValueBag(array(new Value('foo'))));

        $featureVoter->expects(self::once())
            ->method('vote')
            ->with($feature, $context)
            ->willReturn(true);

        $filterBagVoter->expects(self::once())
            ->method('vote')
            ->with(self::isInstanceOf('Dwo\Flagging\Model\FilterBagInterface'), $context)
            ->willReturn(false);

        $decider = new ValueDecider($manager, $featureVoter, $filterBagVoter);
        $result = $decider->decideFeature($feature, $context);

        self::assertEquals(null, $result);
    }

    public function testDecideValueFalseWithDefault()
    {
        $manager = $this->mockManager();
        $featureVoter = $this->mockFeatureVoter();
        $filterBagVoter = $this->mockFilterBagVoter();

        $context = new Context();

        $feature = new Feature('feature', null, null, new ValueBag(array(new Value('foo'))));

        $featureVoter->expects(self::once())
            ->method('vote')
            ->with($feature, $context)
            ->willReturn(true);

        $filterBagVoter->expects(self::once())
            ->method('vote')
            ->with(self::isInstanceOf('Dwo\Flagging\Model\FilterBagInterface'), $context)
            ->willReturn(false);

        $decider = new ValueDecider($manager, $featureVoter, $filterBagVoter);
        $result = $decider->decideFeature($feature, $context, 'bar');

        self::assertEquals('bar', $result);
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|FeatureManagerInterface
     */
    protected function mockManager()
    {
        return $this->getMockBuilder('Dwo\Flagging\Model\FeatureManagerInterface')
            ->disableOriginalConstructor()
            ->getMock();
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|FeatureVoter
     */
    protected function mockFeatureVoter()
    {
        return $this->getMockBuilder('Dwo\Flagging\Voter\FeatureVoter')
            ->disableOriginalConstructor()
            ->getMock();
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|FilterBagVoter
     */
    protected function mockFilterBagVoter()
    {
        return $this->getMockBuilder('Dwo\Flagging\Voter\FilterBagVoter')
            ->disableOriginalConstructor()
            ->getMock();
    }

}
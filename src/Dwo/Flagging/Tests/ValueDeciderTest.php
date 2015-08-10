<?php

namespace Dwo\Flagging\Tests;

use Dwo\Flagging\Context\Context;
use Dwo\Flagging\FeatureDecider;
use Dwo\Flagging\Model\Feature;
use Dwo\Flagging\Model\FeatureManagerInterface;
use Dwo\Flagging\Model\FilterBag;
use Dwo\Flagging\Model\Value;
use Dwo\Flagging\Model\ValueBag;
use Dwo\Flagging\ValueDecider;
use Dwo\Flagging\Voter\FilterGroupsVoter;

class ValueDeciderTest extends \PHPUnit_Framework_TestCase
{
    public function testDecideFeatureValueOk()
    {
        $manager = $this->mockManager();
        $featureDecider = $this->mockFeatureDecider();
        $voter = $this->mockFilterGroupsVoter();

        $context = new Context();

        $value = new ValueBag(array(new Value('foo', new FilterBag(array('bar')))));
        $feature = new Feature('feature', null, null, $value);

        $featureDecider->expects(self::once())
            ->method('decideFeature')
            ->with($feature, $context)
            ->willReturn(true);

        $voter->expects(self::once())
            ->method('vote')
            ->with(self::isType('array'), $context)
            ->willReturn(true);

        $decider = new ValueDecider($manager, $featureDecider, $voter);
        $result = $decider->decideFeature($feature, $context);

        self::assertEquals('foo', $result);
    }

    public function testDecideFeatureValueFalse()
    {
        $manager = $this->mockManager();
        $featureDecider = $this->mockFeatureDecider();
        $voter = $this->mockFilterGroupsVoter();

        $context = new Context();

        $value = new ValueBag(array(new Value('foo', new FilterBag(array('bar')))));
        $feature = new Feature('feature', null, null, $value);

        $featureDecider->expects(self::once())
            ->method('decideFeature')
            ->with($feature, $context)
            ->willReturn(true);

        $voter->expects(self::once())
            ->method('vote')
            ->with(self::isType('array'), $context)
            ->willReturn(false);

        $decider = new ValueDecider($manager, $featureDecider, $voter);
        $result = $decider->decideFeature($feature, $context);

        self::assertEquals(null, $result);
    }

    public function testDecideFeatureValueFalseWithDefault()
    {
        $manager = $this->mockManager();
        $featureDecider = $this->mockFeatureDecider();
        $voter = $this->mockFilterGroupsVoter();

        $context = new Context();

        $value = new ValueBag(array(new Value('foo', new FilterBag(array('bar')))));
        $feature = new Feature('feature', new FilterBag(array()), null, $value);

        $featureDecider->expects(self::once())
            ->method('decideFeature')
            ->with($feature, $context)
            ->willReturn(true);

        $voter->expects(self::once())
            ->method('vote')
            ->with(self::isType('array'), $context)
            ->willReturn(false);

        $decider = new ValueDecider($manager, $featureDecider, $voter);
        $result = $decider->decideFeature($feature, $context, 'bar');

        self::assertEquals('bar', $result);
    }

    public function testDecideValueOk()
    {
        $manager = $this->mockManager();
        $featureDecider = $this->mockFeatureDecider();
        $voter = $this->mockFilterGroupsVoter();

        $context = new Context();
        $value = new ValueBag(array(new Value('foo', new FilterBag(array('bar')))));
        $feature = new Feature('feature', new FilterBag(array()), null, $value);

        $manager->expects(self::once())
            ->method('findFeatureByName')
            ->with('feature')
            ->willReturn($feature);

        $featureDecider->expects(self::once())
            ->method('decideFeature')
            ->with($feature, $context)
            ->willReturn(true);

        $voter->expects(self::once())
            ->method('vote')
            ->with(self::isType('array'), $context)
            ->willReturn(true);

        $decider = new ValueDecider($manager, $featureDecider, $voter);
        $result = $decider->decide('feature', $context);

        self::assertEquals('foo', $result);
    }

    public function testDecideValueIsFeature()
    {
        $manager = $this->mockManager();
        $featureDecider = $this->mockFeatureDecider();
        $voter = $this->mockFilterGroupsVoter();

        $context = new Context();
        $value = new ValueBag(array(new Value('feature2', null, true)));
        $feature = new Feature('feature', new FilterBag(array()), null, $value);

        $value2 = new ValueBag(array(new Value('lorem')));
        $feature2 = new Feature('feature2', new FilterBag(array()), null, $value2);

        $manager->expects(self::exactly(2))
            ->method('findFeatureByName')
            ->withConsecutive(array('feature'), array('feature2'))
            ->willReturnOnConsecutiveCalls($feature, $feature2);

        $featureDecider->expects(self::exactly(2))
            ->method('decideFeature')
            ->withConsecutive(array($feature, $context),array($feature2, $context))
            ->willReturnOnConsecutiveCalls(true, true);

        $decider = new ValueDecider($manager, $featureDecider, $voter);
        $result = $decider->decide('feature', $context);

        self::assertEquals('lorem', $result);
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
     * @return \PHPUnit_Framework_MockObject_MockObject|FeatureDecider
     */
    protected function mockFeatureDecider()
    {
        return $this->getMockBuilder('Dwo\Flagging\FeatureDecider')
            ->disableOriginalConstructor()
            ->getMock();
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|FilterGroupsVoter
     */
    protected function mockFilterGroupsVoter()
    {
        return $this->getMockBuilder('Dwo\Flagging\Voter\FilterGroupsVoter')
            ->disableOriginalConstructor()
            ->getMock();
    }

}
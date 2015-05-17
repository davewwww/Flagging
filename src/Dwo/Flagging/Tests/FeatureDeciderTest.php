<?php

namespace Dwo\Flagging\Tests;

use Dwo\Flagging\Context\Context;
use Dwo\Flagging\FeatureDecider;
use Dwo\Flagging\Model\Feature;
use Dwo\Flagging\Model\FeatureManagerInterface;
use Dwo\Flagging\Voter\FeatureVoter;

class FeatureDeciderTest extends \PHPUnit_Framework_TestCase
{
    public function testDecideFeature()
    {
        $manager = $this->mockManager();
        $voter = $this->mockVoter();
        $context = new Context();

        $feature = new Feature('feature');

        $voter->expects(self::once())
            ->method('vote')
            ->with($feature, $context)
            ->willReturn(true);

        $decider = new FeatureDecider($manager, $voter);
        $result = $decider->decideFeature($feature, $context);

        self::assertTrue($result);
    }

    public function testDecideOk()
    {
        $manager = $this->mockManager();
        $voter = $this->mockVoter();
        $context = new Context();

        $manager->expects(self::once())
            ->method('findFeatureByName')
            ->with('foo')
            ->willReturn($feature = new Feature('feature'));

        $voter->expects(self::once())
            ->method('vote')
            ->with($feature, $context)
            ->willReturn(true);

        $decider = new FeatureDecider($manager, $voter);
        $result = $decider->decide('foo', $context);

        self::assertTrue($result);
    }

    public function testDecideUnknownFeature()
    {
        $manager = $this->mockManager();
        $voter = $this->mockVoter();
        $context = new Context();

        $manager->expects(self::once())
            ->method('findFeatureByName')
            ->with('foo')
            ->willReturn(null);

        $voter->expects(self::never())
            ->method('vote');

        $decider = new FeatureDecider($manager, $voter);
        $result = $decider->decide('foo', $context);

        self::assertNull($result);
    }

    public function testDecideUnknownFeatureWithDefault()
    {
        $manager = $this->mockManager();
        $voter = $this->mockVoter();
        $context = new Context();

        $manager->expects(self::once())
            ->method('findFeatureByName')
            ->with('foo')
            ->willReturn(null);

        $voter->expects(self::never())
            ->method('vote');

        $decider = new FeatureDecider($manager, $voter);
        $result = $decider->decide('foo', $context, true);

        self::assertTrue($result);
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
    protected function mockVoter()
    {
        return $this->getMockBuilder('Dwo\Flagging\Voter\FeatureVoter')
            ->disableOriginalConstructor()
            ->getMock();
    }

}
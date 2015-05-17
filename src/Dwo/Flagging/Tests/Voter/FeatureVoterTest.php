<?php

namespace Dwo\Flagging\Tests\Voter;

use Dwo\Flagging\Context\Context;
use Dwo\Flagging\Model\Feature;
use Dwo\Flagging\Model\FilterBag;
use Dwo\Flagging\Model\FilterGroup;
use Dwo\Flagging\Voter\FeatureVoter;
use Dwo\Flagging\Voter\FilterGroupsVoter;

class FeatureVoterTest extends \PHPUnit_Framework_TestCase
{
    public function testWithFilter()
    {
        $filter = new FilterBag(array(new FilterGroup()));
        $feature = new Feature('foo', $filter);

        $mockVoter = $this->mockVoter();
        $mockVoter->expects(self::once())
            ->method('vote')
            ->willReturn(true);

        $voter = new FeatureVoter($mockVoter);
        $result = $voter->vote($feature, new Context());

        self::assertTrue($result);
    }

    public function testWithFilterFalse()
    {
        $filter = new FilterBag(array(new FilterGroup()));
        $feature = new Feature('foo', $filter);

        $mockVoter = $this->mockVoter();
        $mockVoter->expects(self::once())
            ->method('vote')
            ->willReturn(false);

        $voter = new FeatureVoter($mockVoter);
        $result = $voter->vote($feature, new Context());

        self::assertFalse($result);
    }

    public function testWithoutFilter()
    {
        $feature = new Feature('foo');

        $mockVoter = $this->mockVoter();
        $mockVoter->expects(self::never())
            ->method('vote');

        $voter = new FeatureVoter($mockVoter);
        $result = $voter->vote($feature, new Context());

        self::assertTrue($result);
    }

    public function testWithBreaker()
    {
        $filter = new FilterBag(array(new FilterGroup()));
        $feature = new Feature('foo', null, $filter);

        $mockVoter = $this->mockVoter();
        $mockVoter->expects(self::once())
            ->method('vote')
            ->willReturn(true);

        $voter = new FeatureVoter($mockVoter);
        $result = $voter->vote($feature, new Context());

        self::assertFalse($result);
    }

    public function testWithNoBreakerAndFilterOk()
    {
        $filter = new FilterBag(array(new FilterGroup()));
        $feature = new Feature('foo', $filter, $filter);

        $mockVoter = $this->mockVoter();
        $mockVoter->expects(self::exactly(2))
            ->method('vote')
            ->will($this->onConsecutiveCalls(false, true));

        $voter = new FeatureVoter($mockVoter);
        $result = $voter->vote($feature, new Context());

        self::assertTrue($result);
    }

    public function testDisabled()
    {
        $feature = new Feature('foo');
        $feature->setEnabled(false);

        $mockVoter = $this->mockVoter();
        $mockVoter->expects(self::never())
            ->method('vote');

        $voter = new FeatureVoter($mockVoter);
        $result = $voter->vote($feature, new Context());

        self::assertFalse($result);
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|FilterGroupsVoter
     */
    protected function mockVoter()
    {
        return $this->getMockBuilder('Dwo\Flagging\Voter\FilterGroupsVoter')
            ->disableOriginalConstructor()
            ->getMock();
    }
}
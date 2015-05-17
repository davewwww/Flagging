<?php

namespace Dwo\Flagging\Tests\Voter;

use Dwo\Flagging\Context\Context;
use Dwo\Flagging\Model\FilterBag;
use Dwo\Flagging\Model\FilterGroup;
use Dwo\Flagging\Voter\FilterBagVoter;
use Dwo\Flagging\Voter\FilterGroupsVoter;
use Dwo\Flagging\Voter\VoterInterface;

class FilterBagVoterTest extends \PHPUnit_Framework_TestCase
{
    public function test()
    {
        $filterBag = new FilterBag(array('foo'));
        $context = new Context();

        $mockVoter = $this->mockVoter();
        $mockVoter->expects(self::once())
            ->method('vote')
            ->with(array('foo'), $context)
            ->willReturn(true);

        $voter = new FilterBagVoter($mockVoter);
        $result = $voter->vote($filterBag, $context);

        self::assertTrue($result);
    }

    public function testEmpty()
    {
        $mockVoter = $this->mockVoter();
        $mockVoter->expects(self::never())
            ->method('vote');

        $voter = new FilterBagVoter($mockVoter);
        $result = $voter->vote(new FilterBag(), new Context());

        self::assertTrue($result);
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
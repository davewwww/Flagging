<?php

namespace Dwo\Flagging\Tests\Voter;

use Dwo\Flagging\Context\Context;
use Dwo\Flagging\Model\FilterGroup;
use Dwo\Flagging\Voter\FilterGroupsVoter;
use Dwo\Flagging\Voter\VoterInterface;

class FilterGroupsVoterTest extends \PHPUnit_Framework_TestCase
{
    public function test()
    {
        $filterGroups = new FilterGroup(array('foo'));
        $context = new Context();

        $voter = $this->mockVoter();
        $voter->expects(self::once())
            ->method('vote')
            ->with(self::isType('array'), $context)
            ->willReturn(true);

        $feature = new FilterGroupsVoter($voter);
        $result = $feature->vote(array($filterGroups), $context);

        self::assertTrue($result);
    }

    public function testEmpty()
    {
        $voter = $this->mockVoter();
        $voter->expects(self::never())
            ->method('vote');

        $feature = new FilterGroupsVoter($voter);
        $result = $feature->vote(array(), new Context());

        self::assertTrue($result);
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|VoterInterface
     */
    protected function mockVoter()
    {
        return $this->getMockBuilder('Dwo\Flagging\Voter\EntriesAndVoter')
            ->disableOriginalConstructor()
            ->getMock();
    }
}
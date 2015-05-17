<?php

namespace Dwo\Flagging\Tests\Voter;

use Dwo\Flagging\Context\Context;
use Dwo\Flagging\Model\FilterGroup;
use Dwo\Flagging\Voter\EntriesAndVoter;
use Dwo\Flagging\Voter\FilterGroupsVoter;
use Dwo\Flagging\Voter\VoterInterface;

class EntriesAndVoterTest extends \PHPUnit_Framework_TestCase
{
    public function test()
    {
        $voter = $this->mockVoter();
        $voter->expects(self::once())
            ->method('vote')
            ->with('foo', $context = new Context())
            ->willReturn(true);

        $feature = new EntriesAndVoter($voter);
        $result = $feature->vote(array('foo'), $context);

        self::assertTrue($result);
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|VoterInterface
     */
    protected function mockVoter()
    {
        return $this->getMockBuilder('Dwo\Flagging\Voter\VoterInterface')
            ->disableOriginalConstructor()
            ->getMock();
    }
}
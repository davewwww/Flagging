<?php

namespace Dwo\Flagging\Tests\Voter;

use Dwo\Flagging\Context\Context;
use Dwo\Flagging\Model\Filter;
use Dwo\Flagging\Model\VoterManagerInterface;
use Dwo\Flagging\Voter\FilterVoter;
use Dwo\Flagging\Voter\VoterInterface;

class FilterVoterTest extends \PHPUnit_Framework_TestCase
{
    public function test()
    {
        $filter = new Filter('foo', array('bar'));
        $context = new Context();

        $manager = $this->mockManager();
        $manager->expects(self::once())
            ->method('getVoter')
            ->with('foo')
            ->willReturn($voter = $this->mockVoter());

        $voter->expects(self::once())
            ->method('vote')
            ->with(array('bar'), $context)
            ->willReturn(true);

        $feature = new FilterVoter($manager);
        $result = $feature->vote($filter, $context);

        self::assertTrue($result);
    }

    /**
     * @expectedException \Dwo\Flagging\Exception\FlaggingException
     */
    public function testException()
    {
        $manager = $this->mockManager();
        $manager->expects(self::never())
            ->method('getVoter');


        $feature = new FilterVoter($manager);
        $result = $feature->vote('foo', new Context());

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

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|VoterManagerInterface
     */
    protected function mockManager()
    {
        return $this->getMockBuilder('Dwo\Flagging\Model\VoterManagerInterface')
            ->disableOriginalConstructor()
            ->getMock();
    }
}
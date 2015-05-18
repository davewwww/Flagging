<?php

namespace Dwo\Flagging\Tests\Voter;

use Dwo\Flagging\Context\Context;
use Dwo\Flagging\Model\Filter;
use Dwo\Flagging\Voter\CachedFilterVoter;
use Dwo\Flagging\Voter\FilterVoter;

class CachedFilterVoterTest extends \PHPUnit_Framework_TestCase
{
    public function test()
    {
        $filter = new Filter('foo');

        $voter = $this->mockVoter();
        $voter->expects(self::once())
            ->method('vote')
            ->with($filter, $context = new Context())
            ->willReturn(true);

        $feature = new CachedFilterVoter($voter);
        $result = $feature->vote($filter, $context);

        self::assertTrue($result);
        self::assertTrue($context->getResultCache()->getResult('foo_null'));
    }

    public function testCached()
    {
        $filter = new Filter('foo');

        $voter = $this->mockVoter();
        $voter->expects(self::once())
            ->method('vote')
            ->with($filter, $context = new Context())
            ->willReturn(true);

        $feature = new CachedFilterVoter($voter);
        $result = $feature->vote($filter, $context);
        self::assertTrue($result);

        $result = $feature->vote($filter, $context);
        self::assertTrue($result);
    }

    public function testNotCached()
    {
        $filter = new Filter('foo');
        $context = new Context();

        $voter = $this->mockVoter();
        $voter->expects(self::once())
            ->method('vote')
            ->with($filter, $context)
            ->willReturn(true);

        $feature = new CachedFilterVoter($voter);
        $result = $feature->vote($filter, $context);
        self::assertTrue($result);

        $filter = new Filter('foobar');

        $voter = $this->mockVoter();
        $voter->expects(self::once())
            ->method('vote')
            ->with($filter, $context)
            ->willReturn(true);

        $feature = new CachedFilterVoter($voter);
        $result = $feature->vote($filter, $context);
        self::assertTrue($result);

        $cache = $context->getResultCache();
        self::assertTrue($cache->getResult('foo_null'));
        self::assertTrue($cache->getResult('foobar_null'));
    }

    /**
     * @expectedException \Dwo\Flagging\Exception\FlaggingException
     */
    public function testInvalidArgument()
    {
        $voter = $this->mockVoter();
        $voter->expects(self::never())
            ->method('vote');

        $feature = new CachedFilterVoter($voter);
        $feature->vote('foo', new Context());
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|FilterVoter
     */
    protected function mockVoter()
    {
        return $this->getMockBuilder('Dwo\Flagging\Voter\FilterVoter')
            ->disableOriginalConstructor()
            ->getMock();
    }
}
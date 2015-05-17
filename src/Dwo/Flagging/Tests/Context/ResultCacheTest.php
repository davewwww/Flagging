<?php

namespace Dwo\Flagging\Tests\Context;

use Dwo\Flagging\Context\ResultCache;

class ResultCacheTest extends \PHPUnit_Framework_TestCase
{
    public function testAddResult()
    {
        $resultCache = new ResultCache();
        $resultCache->addResult('foo', true);
        $resultCache->addResult('bar', false);

        self::assertTrue($resultCache->getResult('foo'));
        self::assertFalse($resultCache->getResult('bar'));
    }

    public function testGetResultNull()
    {
        $resultCache = new ResultCache();

        self::assertNull($resultCache->getResult('foo'));
    }
}
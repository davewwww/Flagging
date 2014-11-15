<?php

namespace Lab\Component\Flagging\Tests;

use Lab\Component\Flagging\Comparison\BetweenComparison;
use Lab\Component\Flagging\Comparison\BoolComparison;
use Lab\Component\Flagging\Comparison\ContainerComparison;
use Lab\Component\Flagging\Comparison\DateFormatComparison;
use Lab\Component\Flagging\Comparison\DefaultComparison;
use Lab\Component\Flagging\Comparison\DefaultOperatorComparison;
use Lab\Component\Flagging\Comparison\ModulousComparison;
use Lab\Component\Flagging\Comparison\SubstrComparison;
use Lab\Component\Flagging\Comparison\VersionComparison;

class ComparisonTest extends \PHPUnit_Framework_TestCase
{
    public function testContainerComparison()
    {
        $containerComparison = new ContainerComparison(
            array(
                DefaultComparison::NAME => $defaultComparison = new DefaultComparison(),
                VersionComparison::NAME => $versionComparison = new VersionComparison(),
            )
        );

        $this->assertInstanceOf(
            get_class($defaultComparison),
            $containerComparison->getComparison(
                DefaultComparison::NAME
            )
        );
        $this->assertInstanceOf(
            get_class($versionComparison),
            $containerComparison->getComparison(
                VersionComparison::NAME
            )
        );
    }

    public function testDefaultOperatorComparison()
    {
        $closures = (new DefaultOperatorComparison())->getAllComparisons();

        $this->assertTrue($closures["<"](1, 2));
        $this->assertTrue($closures["<="](2, 2));
        $this->assertTrue($closures[">"](2, 1));
        $this->assertTrue($closures[">="](1, 1));
        $this->assertTrue($closures["!="](1, 2));
        $this->assertTrue($closures["=="](2, 2));

        $this->assertFalse($closures["<"](2, 1));
        $this->assertFalse($closures["<="](2, 1));
        $this->assertFalse($closures[">"](1, 2));
        $this->assertFalse($closures[">="](1, 2));
        $this->assertFalse($closures["!="](1, 1));
        $this->assertFalse($closures["=="](1, 2));
    }

    public function testModulousComparison()
    {
        $closure = (new ModulousComparison())->getComparison();

        $etalon = 3;
        $this->assertTrue($closure("1", $etalon));
        $this->assertTrue($closure(3, $etalon));

        $this->assertFalse($closure("4", $etalon));
    }

    public function testBoolComparison()
    {
        $closure = (new BoolComparison())->getComparison();

        $etalon = "true";
        $this->assertTrue($closure(true, $etalon));
        $this->assertTrue($closure(1, $etalon));
        $this->assertTrue($closure(10, $etalon));
        $this->assertTrue($closure("true", $etalon));

        $this->assertFalse($closure(false, $etalon));
        $this->assertFalse($closure(0, $etalon));

        $etalon = false;
        $this->assertTrue($closure(false, $etalon));
        $this->assertTrue($closure("false", $etalon));

        $this->assertFalse($closure(true, $etalon));
        $this->assertFalse($closure("true", $etalon));
    }

    public function testSubstrComparison()
    {
        $closure = (new SubstrComparison())->getComparison();

        $etalon = "lorem ipsum foo bar";
        $this->assertTrue($closure("lorem", $etalon));
        $this->assertTrue($closure("foo bar", $etalon));

        $this->assertFalse($closure("sun", $etalon));
        $this->assertFalse($closure("foobar", $etalon));
    }

    public function testDefaultComparison()
    {
        $closure = (new DefaultComparison())->getComparison();

        $etalon = "foobar";
        $this->assertTrue($closure("foobar", $etalon));
        $this->assertFalse($closure("lorem", $etalon));

        $etalon = array("foo", "bar");
        $this->assertTrue($closure("foo", $etalon));
        $this->assertFalse($closure("lorem", $etalon));
    }

    public function testBetweenComparison()
    {
        $closure = (new BetweenComparison())->getComparison();

        $etalon = 50;
        $this->assertTrue($closure($etalon, 1, 100));
        $this->assertTrue($closure($etalon, 50, 50));

        $this->assertFalse($closure($etalon, 1, 49));
        $this->assertFalse($closure($etalon, 51, 10));
    }

    public function testSameDayComparison()
    {
        $closure = (new DateFormatComparison("day", "Y-m-d"))->getComparison();

        $etalon = "2014-01-01";
        $this->assertTrue($closure($etalon, $etalon));
        $this->assertTrue($closure($etalon, new \DateTime($etalon)));
        $this->assertTrue($closure(new \DateTime($etalon), new \DateTime($etalon)));
        $this->assertTrue($closure(new \DateTime($etalon), $etalon));

        $etalon = "2014-01-01";
        $error = "2000-01-01";
        $this->assertFalse($closure($etalon, $error));
        $this->assertFalse($closure($etalon, new \DateTime($error)));
        $this->assertFalse($closure(new \DateTime($etalon), new \DateTime($error)));
        $this->assertFalse($closure(new \DateTime($etalon), $error));
    }

    public function testVersionComparison()
    {
        $closure = (new VersionComparison())->getComparison();

        $etalon = "2.0";
        $operator = "gt";
        $this->assertTrue($closure($etalon, "1.0", $operator));
        $this->assertTrue($closure($etalon, "1.5", $operator));
        $this->assertTrue($closure($etalon, "1.7.1", $operator));

        $operator = "lt";
        $this->assertTrue($closure($etalon, "3.0", $operator));
        $this->assertTrue($closure($etalon, "3.5", $operator));
        $this->assertTrue($closure($etalon, "3.7.1", $operator));

        $etalon = "2.0";
        $operator = "lt";
        $this->assertFalse($closure($etalon, "1.0", $operator));
    }
}
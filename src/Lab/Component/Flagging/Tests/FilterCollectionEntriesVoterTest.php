<?php

namespace Lab\Component\Flagging\Tests;

use Lab\Component\Flagging\Model\Filter;
use Lab\Component\Flagging\Model\FilterCollection;
use Lab\Component\Flagging\Context\Context;

class FilterCollectionEntriesVoterTest extends Fixtures {

    public function testSecondVoterMatch() {

        $filtervoter = $this->getFilterCollectionEntriesVoter();
        $context = new Context();

        $this->assertTrue($filtervoter->vote(array(
            new FilterCollection(array(
                new Filter("substr", "lorem"),
            )),
            new FilterCollection(array(
                new Filter("substr", "foo"),
            ))
        ), $context));

    }

    public function testOneMultipleVoterMatch() {
        $filtervoter = $this->getFilterCollectionEntriesVoter();
        $context = new Context();

        $this->assertTrue($filtervoter->vote(array(
            new FilterCollection(array(
                new Filter("substr", "lorem"),
            )),
            new FilterCollection(array(
                new Filter("substr", "foo"),
                new Filter("date_range", array( "from" => "-1 day", "to" => "+1 day" )),
            ))
        ), $context));
    }

    public function testTwoSingleVoterDontMatch() {
        $filtervoter = $this->getFilterCollectionEntriesVoter();
        $context = new Context();

        $this->assertFalse($filtervoter->vote(array(
            new FilterCollection(array(
                new Filter("substr", "lorem"),
            )),
            new FilterCollection(array(
                new Filter("substr", "ipsum"),
            ))
        ), $context));
    }

    public function testTwoMultipleVoterDontMatch() {
        $filtervoter = $this->getFilterCollectionEntriesVoter();
        $context = new Context();

        $this->assertFalse($filtervoter->vote(array(
            new FilterCollection(array(
                new Filter("substr", "lorem"),
            )),
            new FilterCollection(array(
                new Filter("substr", "foo"),
                new Filter("date_range", array( "from" => "+1 day", "to" => "+2 day" )),
            ))
        ), $context));
    }
}
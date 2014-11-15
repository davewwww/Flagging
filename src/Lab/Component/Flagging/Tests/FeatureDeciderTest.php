<?php

namespace Lab\Component\Flagging\Tests;

use Lab\Component\Flagging\Model\Feature;
use Lab\Component\Flagging\Model\Filter;
use Lab\Component\Flagging\Model\FilterCollection;
use Lab\Component\Flagging\Context\Context;

class FeatureDeciderTest extends Fixtures {

    public function testFeatureDecider() {
        $featureDecider = $this->getFeatureDecider();
        $context = new Context();

        $feature = new Feature("feature", array(
            new FilterCollection(array(
                new Filter("substr", "foo")
            ))
        ));
        $this->assertTrue($featureDecider->decideFeature($feature, $context));

        $feature = new Feature("feature", array(
            new FilterCollection(array(
                new Filter("substr", "foo"),
                new Filter("date_range", array( "from" => "-1 day", "to" => "+2 day" )),
            ))
        ));
        $this->assertTrue($featureDecider->decideFeature($feature, $context));

        $feature = new Feature("feature", array(
            new FilterCollection(array(
                new Filter("substr", "lorem"),
            ))
        ));
        $this->assertFalse($featureDecider->decideFeature($feature, $context));

        $feature = new Feature("feature", array(
            new FilterCollection(array(
                new Filter("substr", "lorem"),
            )),
            new FilterCollection(array(
                new Filter("substr", "foo")
            ))
        ));
        $this->assertTrue($featureDecider->decideFeature($feature, $context));

        $feature = new Feature("feature", array(
            new FilterCollection(array(
                new Filter("substr", "lorem"),
            )),
            new FilterCollection(array(
                new Filter("substr", "foo"),
                new Filter("date_range", array( "from" => "+1 day", "to" => "+2 day" )),
            ))
        ));
        $this->assertFalse($featureDecider->decideFeature($feature, $context));
    }

}
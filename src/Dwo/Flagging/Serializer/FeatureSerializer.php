<?php

namespace Dwo\Flagging\Serializer;

use Dwo\Flagging\Model\FeatureInterface;
use Dwo\Flagging\Model\FilterGroupInterface;
use Dwo\Flagging\Model\ValueBagInterface;

/**
 * @author Dave Www <davewwwo@gmail.com>
 */
class FeatureSerializer
{
    /**
     * @param FeatureInterface $feature
     *
     * @return array
     */
    public static function serialize(FeatureInterface $feature)
    {
        $class = new self();

        return $class->serializeFeature($feature);
    }

    /**
     * @param FeatureInterface $feature
     *
     * @return array
     */
    public function serializeFeature(FeatureInterface $feature)
    {
        $return = [];

        $filters = $this->serializeFilterGroups($feature->getFilter()->getFilterGroups());
        if(!empty($filters)) {
            $return['filters'] = $filters;
        }

        $breaker = $this->serializeFilterGroups($feature->getBreaker()->getFilterGroups());
        if(!empty($breaker)) {
            $return['breaker'] = $breaker;
        }

        $values = $this->serializeValueBag($feature->getValue());
        if(!empty($values)) {
            $return['values'] = $values;
        }

        if(!$feature->isEnabled()){
            $return['enabled'] = false;
        }

        return $return;
    }

    /**
     * @param ValueBagInterface $valueBag
     *
     * @return array
     */
    public function serializeValueBag(ValueBagInterface $valueBag)
    {
        $return = [];

        foreach ($valueBag->getValues() as $value) {

            $serialized = array(
                'value' => $value->getValue()
            );

            $filters = $this->serializeFilterGroups($value->getFilter()->getFilterGroups());
            if(!empty($filters)) {
                $serialized['filters'] = $filters;
            }

            $return[] =  $serialized;
        }

        return $return;
    }

    /**
     * @param FilterGroupInterface[] $filterGroups
     *
     * @return array
     */
    public function serializeFilterGroups(array $filterGroups = array())
    {
        $return = [];
        foreach ($filterGroups as $filterGroup) {
            $filters = [];
            foreach ($filterGroup->getFilters() as $filter) {
                $filters[$filter->getName()] = $filter->getParameter();
            }
            $return[] = $filters;
        }

        return $return;
    }
}
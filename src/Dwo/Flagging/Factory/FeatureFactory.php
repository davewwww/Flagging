<?php

namespace Dwo\Flagging\Factory;

use Dwo\Flagging\Model\Feature;
use Dwo\Flagging\Model\Filter;
use Dwo\Flagging\Model\FilterBag;
use Dwo\Flagging\Model\FilterGroup;
use Dwo\Flagging\Model\Value;
use Dwo\Flagging\Model\ValueBag;

/**
 * @author Dave Www <davewwwo@gmail.com>
 */
class FeatureFactory
{
    /**
     * @param string $name
     * @param array  $data
     *
     * @return Feature
     */
    public static function buildFeature($name, array $data = array())
    {
        $values = [];

        $value = null;
        if (isset($data['values'])) {
            foreach ($data['values'] as $value) {

                $filter = $isFeature = null;
                if (isset($value['filters']) && !empty($value['filters'])) {
                    $filter = self::buildFilterBag($value['filters']);
                }
                if (isset($value['is_feature'])) {
                    $isFeature = (bool) $value['is_feature'];
                }

                $values[] = new Value($value['value'], $filter, $isFeature);
            }
            $value = new ValueBag($values);
        }

        $filter = null;
        if (isset($data['filters']) && !empty($data['filters'])) {
            $filter = self::buildFilterBag($data['filters']);
        }

        $breaker = null;
        if (isset($data['breaker']) && !empty($data['breaker'])) {
            $breaker = self::buildFilterBag($data['breaker']);
        }

        $feature = new Feature($name, $filter, $breaker, $value);

        if (isset($data['enabled']) && !$data['enabled']) {
            $feature->setEnabled(false);
        }

        return $feature;
    }

    /**
     * @param array $data
     *
     * @return FilterBag
     */
    public static function buildFilterBag(array $data)
    {
        $filterGroups = [];

        foreach ($data as $filters) {
            $filterObj = [];
            foreach ($filters as $filterName => $filterConfig) {
                $filterObj[] = new Filter($filterName, $filterConfig);
            }
            $filterGroups[] = new FilterGroup($filterObj);
        }

        return new FilterBag($filterGroups);
    }
}
<?php

namespace Dwo\Flagging\Extractor;

use Dwo\Flagging\Model\Feature;
use Dwo\Flagging\Serializer\FeatureSerializer;

/**
 * @author Dave Www <davewwwo@gmail.com>
 */
class VoterExtractor
{
    /**
     * extract all voter names
     *
     * @param Feature $feature
     *
     * @return array
     */
    public static function extract(Feature $feature)
    {
        $serialized = FeatureSerializer::serialize($feature);

        return self::extractFromArray($serialized);
    }

    /**
     * extract all voter names from a serialized feature
     *
     * @param $value
     *
     * @return array
     */
    public static function extractFromArray($value)
    {
        /**
         * @param array $filters
         *
         * @return array
         */
        $extractVoters = function (array $filters) {
            $voters = [];
            foreach ($filters as $filter) {
                if (is_array($filter)) {
                    $voters = array_merge($voters, array_keys($filter));
                }
            }

            return array_unique($voters);
        };

        $voters = [];
        if (isset($value['filters'])) {
            $voters = array_merge($voters, $extractVoters($value['filters']));
        }
        if (isset($value['breaker'])) {
            $voters = array_merge($voters, $extractVoters($value['breaker']));
        }
        if (isset($value['values'])) {
            foreach ($value['values'] as $valueValue) {
                if (isset($valueValue['filters'])) {
                    $voters = array_merge($voters, $extractVoters($valueValue['filters']));
                }
            }
        }

        return array_values(array_unique($voters));
    }
}
<?php

namespace Lab\Component\Flagging\Context;

/**
 * :TODO: refactor
 *
 * @author David Wolter <david@dampfer.net>
 */
class CachedContext extends Context
{
    /**
     * @var array
     */
    protected $results;

    /**
     * @deprecated
     * :TODO: use own Cache Obj
     * @return array
     */
    function getResults()
    {
        return $this->results;
    }

    /**
     * @deprecated
     * :TODO: use own Cache Obj
     *
     * @param string $resultId
     *
     * @return Boolean|null
     */
    function getResult($resultId)
    {
        return isset($this->results[$resultId]) ? $this->results[$resultId] : null;
    }

    /**
     * @deprecated
     * :TODO: use own Cache Obj
     *
     * @param string  $resultId
     * @param Boolean $result
     */
    function setResult($resultId, $result)
    {
        $this->results[$resultId] = $result;
    }

    /**
     * @deprecated
     * :TODO: use own Cache Obj
     *
     * @param string $voterName
     *
     * @return string
     */
    function createResultId($voterName)
    {
//        if (is_array($params = $this->getParams())) {
//            foreach ($params as $key => $value) {
//                if (is_object($value)) {
//                    if (method_exists($value, "getId")) {
//                        $voterConfig[$key] = $value->getId();
//                    }
//                }
//            }
//        }

        return $voterName."_".json_encode($this->getConfig());
    }
}

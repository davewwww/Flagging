<?php

namespace Lab\Component\Flagging;

use Lovoo\Component\Common\Model\Nameable;
use Lovoo\Component\Common\Model\Parameters;

/**
 *
 * @author David Wolter <david@dampfer.net>
 */
class VoteContext
{
    /**
     *
     * :TODO: remove traits
     */
    use Parameters, Nameable;

    /**
     * @var array|null
     */
    protected $config;

    /**
     * @var array
     */
    protected $results;

    /**
     * @param array|null  $params
     * @param string|null $name
     */
    public function __construct(array $params = null, $name = null)
    {
        $this->params = $params;
        $this->name = $name;
    }

    /**
     * @param mixed|null $key
     *
     * @return array|null
     */
    function getConfig($key = null)
    {
        if (null !== $key) {
            return isset($this->config[$key]) ? $this->config[$key] : null;
        }

        return $this->config;
    }

    /**
     * @param array $config
     */
    function setConfig(array $config = null)
    {
        $this->config = $config;
    }

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

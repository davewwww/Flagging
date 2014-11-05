<?php

namespace Lab\Component\Flagging;

/**
 * @author David Wolter <david@dampfer.net>
 */
class VoteContext
{
    /**
     * @var string|null
     */
    protected $name;

    /**
     * @var Boolean
     */
    protected $params;

    /**
     * @var array|null
     */
    protected $config;

    /**
     * @var array
     */
    protected $results;

    /**
     * @param array|null $params
     * @param string|null $name
     */
    public function __construct(array $params = null, $name = null)
    {
        $this->params = $params;
        $this->name = $name;
    }

    /**
     * Returns the parameters.
     *
     * @return array
     */
    public function getParams()
    {
        return null !== $this->params ? $this->params : array();
    }

    /**
     * Returns the value for the specified key.
     *
     * @param string $key
     *
     * @return mixed
     */
    public function getParam($key)
    {
        return null !== $this->params && isset($this->params[$key]) ? $this->params[$key] : null;
    }

    /**
     * @param string $key
     *
     * @return bool
     */
    public function hasParam($key)
    {
        return isset($this->params[$key]);
    }

    /**
     * Sets the value for the specified key.
     *
     * @param string $key
     * @param mixed $value
     */
    public function setParam($key, $value)
    {
        if (null === $this->params) {
            $this->params = array();
        }

        $this->params[$key] = $value;
    }

    /**
     * Removes the parameters.
     *
     * @param string $key
     */
    public function removeParam($key)
    {
        if (null !== $this->params) {
            unset($this->params[$key]);
            if (empty($this->params)) {
                $this->params = null;
            }
        }
    }

    /**
     * Sets the parameters.
     *
     * @param array $params
     */
    public function setParams(array $params = null)
    {
        $this->params = $params;
        if (null !== $params && empty($params)) {
            $this->params = null;
        }
    }

    /**
     * merge new paramters
     *
     * @param array $parameters
     */
    public function addParams(array $parameters)
    {
        $this->params = array_merge((array)$this->params, $parameters);
    }

    /**
     * @return string|null
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
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
     * @param string $resultId
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

        return $voterName . "_" . json_encode($this->getConfig());
    }
}

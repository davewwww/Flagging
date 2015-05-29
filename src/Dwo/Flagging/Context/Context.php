<?php

namespace Dwo\Flagging\Context;

/**
 * :TODO: remove deprecated
 *
 * @author Dave Www <davewwwo@gmail.com>
 */
class Context
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
     * @var ResultCache
     */
    public $resultCache;

    /**
     * @param array|null       $params
     * @param string|null      $name
     * @param ResultCache|null $resultCache
     */
    public function __construct(array $params = null, $name = null, ResultCache $resultCache = null)
    {
        $this->params = $params;
        $this->name = $name;
        $this->resultCache = $resultCache ?: new ResultCache();
    }

    /**
     * @param mixed|null $key
     *
     * @return array|null
     */
    public function getConfig($key = null)
    {
        if (null !== $key) {
            return isset($this->config[$key]) ? $this->config[$key] : null;
        }

        return $this->config;
    }

    /**
     * @param array $config
     */
    public function setConfig(array $config = null)
    {
        $this->config = $config;
    }

    /**
     * @deprecated
     * Returns the parameters.
     *
     * @return array
     */
    public function getParams()
    {
        return null !== $this->params ? $this->params : array();
    }

    /**
     * @deprecated
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
     * @deprecated
     *
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
     * @param mixed  $value
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
        $this->params = array_merge((array) $this->params, $parameters);
    }

    /**
     * @deprecated
     * @return string|null
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @deprecated
     *
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return ResultCache
     */
    public function getResultCache()
    {
        return $this->resultCache;
    }
}

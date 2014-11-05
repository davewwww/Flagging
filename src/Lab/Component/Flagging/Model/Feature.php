<?php

namespace Lab\Component\Flagging\Model;

/**
 * @author David Wolter <david@dampfer.net>
 */
class Feature implements FeatureInterface
{
    protected $name;
    protected $filters;
    protected $values;
    protected $enabled = true;
    protected $requiredParameters = array();

    function __construct($name, $filters = null, $values = null)
    {
        $this->name = $name;
        $this->filters = $filters;
        $this->values = $values;
    }

    /**
     * @return mixed
     */
    public function getFilters()
    {
        return $this->filters;
    }

    /**
     * @param mixed $filters
     */
    public function setFilters(array $filters)
    {
        $this->filters = $filters;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getValues()
    {
        return $this->values;
    }

    /**
     * @param mixed $values
     */
    public function setValues($values)
    {
        $this->values = $values;
    }

    /**
     * @return array
     */
    function getRequiredParameters()
    {
        return $this->requiredParameters;
    }

    /**
     * @return bool
     */
    function isEnabled()
    {
        return $this->enabled;
    }
}
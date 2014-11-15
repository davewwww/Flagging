<?php

namespace Lab\Component\Flagging\Model;

/**
 * @author David Wolter <david@dampfer.net>
 */
class Feature implements FeatureInterface
{
    use FiltersTrait;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var null|ValueInterface[]
     */
    protected $values;

    /**
     * @var bool
     */
    protected $enabled = true;

    /**
     * @var array
     */
    protected $requiredParameters = array();

    /**
     * @param string                      $name
     * @param FilterCollectionInterface[] $filters
     * @param ValueInterface[]            $values
     */
    function __construct($name, $filters = null, array $values = null)
    {
        $this->name = $name;
        $this->setFilters($filters);
        $this->values = $values;
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
     * @return null|ValueInterface[]
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
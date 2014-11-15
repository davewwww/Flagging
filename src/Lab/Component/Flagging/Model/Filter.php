<?php

namespace Lab\Component\Flagging\Model;

/**
 * @author David Wolter <david@dampfer.net>
 */
class Filter implements FilterInterface
{
    /**
     * @var string
     */
    protected $name;

    /**
     * @var null|array
     */
    protected $parameter;

    /**
     * @param string $name
     * @param array  $parameter
     */
    function __construct($name, array $parameter = null)
    {
        $this->name = $name;
        $this->parameter = $parameter;
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * {@inheritdoc}
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * {@inheritdoc}
     */
    public function getParameter()
    {
        return $this->parameter;
    }

    /**
     * {@inheritdoc}
     */
    public function setParameter($parameter)
    {
        $this->parameter = $parameter;
    }
}
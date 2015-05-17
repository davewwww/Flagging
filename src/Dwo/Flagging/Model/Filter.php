<?php

namespace Dwo\Flagging\Model;

/**
 * @author David Wolter <david@lovoo.com>
 */
class Filter implements FilterInterface
{
    use NameTrait;

    /**
     * @var mixed
     */
    protected $parameter;

    /**
     * @param string $name
     * @param mixed  $parameter
     */
    public function __construct($name, $parameter = null)
    {
        $this->name = $name;
        $this->parameter = $parameter;
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

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->getName()."_".json_encode($this->getParameter());
    }
}
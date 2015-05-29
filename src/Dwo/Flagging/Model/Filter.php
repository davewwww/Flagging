<?php

namespace Dwo\Flagging\Model;

/**
 * @author Dave Www <davewwwo@gmail.com>
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
     * @return string
     */
    public function __toString()
    {
        return $this->getName()."_".json_encode($this->getParameter());
    }
}
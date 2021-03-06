<?php

namespace Dwo\Flagging\Model;

/**
 * @author Dave Www <davewwwo@gmail.com>
 */
trait NameTrait
{
    /**
     * @var string|null
     */
    protected $name;

    /**
     * @return string|null
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string|null $name
     */
    public function setName($name = null)
    {
        $this->name = $name;
    }
}
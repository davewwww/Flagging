<?php

namespace Dwo\Flagging\Model;

/**
 * @author Dave Www <davewwwo@gmail.com>
 */
interface NameInterface
{
    /**
     * @return string|null
     */
    public function getName();

    /**
     * @param string|null $name
     */
    public function setName($name = null);
}
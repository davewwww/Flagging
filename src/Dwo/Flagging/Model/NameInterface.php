<?php

namespace Dwo\Flagging\Model;

/**
 * @author David Wolter <david@lovoo.com>
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
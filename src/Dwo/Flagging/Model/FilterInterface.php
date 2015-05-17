<?php

namespace Dwo\Flagging\Model;

/**
 * @author David Wolter <david@lovoo.com>
 */
interface FilterInterface extends NameInterface
{
    /**
     * @return mixed
     */
    public function getParameter();

    /**
     * @param mixed $parameters
     */
    public function setParameter($parameters);
}
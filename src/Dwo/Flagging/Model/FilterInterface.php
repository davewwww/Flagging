<?php

namespace Dwo\Flagging\Model;

/**
 * @author Dave Www <davewwwo@gmail.com>
 */
interface FilterInterface extends NameInterface
{
    /**
     * @return mixed
     */
    public function getParameter();
}
<?php

namespace Dwo\Flagging\Model;

/**
 * @author Dave Www <davewwwo@gmail.com>
 */
interface ValueBagInterface
{
    /**
     * @return ValueInterface[]
     */
    public function getValues();
}
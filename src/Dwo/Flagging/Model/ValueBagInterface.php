<?php

namespace Dwo\Flagging\Model;

/**
 * @author David Wolter <david@lovoo.com>
 */
interface ValueBagInterface
{
    /**
     * @return ValueInterface[]
     */
    public function getValues();
}
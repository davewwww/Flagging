<?php

namespace Dwo\Flagging\Model;

/**
 * @author Dave Www <davewwwo@gmail.com>
 */
interface ValueInterface
{
    /**
     * @return mixed
     */
    public function getValue();

    /**
     * @return FilterBagInterface
     */
    public function getFilter();
}
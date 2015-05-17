<?php

namespace Dwo\Flagging\Model;

/**
 * @author David Wolter <david@lovoo.com>
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
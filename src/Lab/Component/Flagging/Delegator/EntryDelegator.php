<?php

namespace Lab\Component\Flagging\Delegator;


/**
 * @author David Wolter <david@dampfer.net>
 */
class EntryDelegator implements EntryDelegatorInterface
{
    /**
     * @param string   $entry
     * @param callable $closure
     *
     * @return bool
     */
    public function delegate($entry, \Closure $closure)
    {
        return $closure($entry);
    }
}

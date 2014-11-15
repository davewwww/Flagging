<?php

namespace Lab\Component\Flagging\Delegator;

/**
 * @author David Wolter <david@dampfer.net>
 */
class EntryDelegator implements EntryDelegatorInterface
{
    /**
     * {@inheritdoc}
     */
    public function delegate($entry, \Closure $closure)
    {
        return $closure($entry);
    }
}

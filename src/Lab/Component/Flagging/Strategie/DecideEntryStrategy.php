<?php

namespace Lab\Component\Flagging\Strategie;

/**
 * @author David Wolter <david@dampfer.net>
 */
class DecideEntryStrategy implements DecideEntryStrategyInterface
{
    /**
     * @param string   $entry
     * @param callable $closure
     *
     * @return bool
     */
    public function decide($entry, \Closure $closure)
    {
        return $closure($entry);
    }
}

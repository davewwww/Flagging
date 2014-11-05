<?php

namespace Lab\Component\Flagging\Strategie;

/**
 * @author David Wolter <david@dampfer.net>
 */
interface DecideEntryStrategyInterface
{
    /**
     * @param string   $entry
     * @param callable $closure
     */
    public function decide($entry, \Closure $closure);
}

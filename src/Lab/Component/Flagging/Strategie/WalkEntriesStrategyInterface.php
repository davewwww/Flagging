<?php

namespace Lab\Component\Flagging\Strategie;

/**
 * @author David Wolter <david@dampfer.net>
 */
interface WalkEntriesStrategyInterface
{
    /**
     * @param array    $entries
     * @param callable $closure
     */
    public function walk($entries, \Closure $closure);
}

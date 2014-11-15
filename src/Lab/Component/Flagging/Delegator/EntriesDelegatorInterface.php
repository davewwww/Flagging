<?php

namespace Lab\Component\Flagging\Delegator;

/**
 * @author David Wolter <david@dampfer.net>
 */
interface EntriesDelegatorInterface
{
    /**
     * @param array    $entries
     * @param callable $closure
     */
    public function delegate(array $entries, \Closure $closure);
}
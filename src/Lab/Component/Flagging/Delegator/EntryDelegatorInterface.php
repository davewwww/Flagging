<?php

namespace Lab\Component\Flagging\Delegator;

/**
 * @author David Wolter <david@dampfer.net>
 */
interface EntryDelegatorInterface {
    /**
     * @param mixed $entry
     * @param callable $closure
     */
    public function delegate($entry, \Closure $closure);
}

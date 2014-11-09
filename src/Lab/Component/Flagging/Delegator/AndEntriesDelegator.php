<?php

namespace Lab\Component\Flagging\Delegator;

/**
 * @author David Wolter <david@dampfer.net>
 */
class AndEntriesDelegator implements EntriesDelegatorInterface {
    /**
     * @var EntryDelegatorInterface
     */
    protected $delegateEntry;

    /**
     * @param EntryDelegatorInterface $delegateEntry
     */
    function __construct(EntryDelegatorInterface $delegateEntry) {
        $this->delegateEntry = $delegateEntry;
    }

    /**
     * @param array $entries
     * @param callable $closure
     *
     * @return bool
     */
    public function delegate(array $entries, \Closure $closure) {
        foreach( $entries as $value ) {
            if( !$this->delegateEntry->delegate($value, $closure) ) {
                return false;
            }
        }

        return true;
    }
}

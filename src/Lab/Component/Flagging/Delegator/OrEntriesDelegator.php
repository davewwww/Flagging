<?php

namespace Lab\Component\Flagging\Delegator;

/**
 * @author David Wolter <david@dampfer.net>
 */
class OrEntriesDelegator implements EntriesDelegatorInterface {
    /**
     * @var EntryDelegatorInterface
     */
    protected $entryDelegator;

    /**
     * @param EntryDelegatorInterface $entryDelegator
     */
    function __construct(EntryDelegatorInterface $entryDelegator) {
        $this->entryDelegator = $entryDelegator;
    }

    /**
     * @param array $entries
     * @param callable $closure
     *
     * @return bool
     */
    public function delegate(array $entries, \Closure $closure) {
        foreach( $entries as $value ) {
            if( $this->entryDelegator->delegate($value, $closure) ) {
                return true;
            }
        }

        return false;
    }
}

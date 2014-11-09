<?php

namespace Lab\Component\Flagging\Delegator;

use Lab\Component\Flagging\Delegator\EntriesDelegatorInterface;
use Lab\Component\Flagging\Delegator\EntryDelegatorInterface;

/**
 * @author David Wolter <david@dampfer.net>
 */
class AndOrEntriesDelegator implements EntriesDelegatorInterface {
    /**
     * @var EntriesDelegatorInterface
     */
    protected $andDelegator;

    /**
     * @var EntriesDelegatorInterface
     */
    protected $orDelegator;

    /**
     * @var EntryDelegatorInterface
     */
    protected $entryDelegator;

    /**
     * @param array $entries
     * @param callable $closure
     *
     * @return bool
     */
    public function delegate(array $entries, \Closure $closure) {
        return $this->andDelegator->delegate($entries, function ($entry) use ($closure) {
            if( is_array($entry) ) {
                return $this->orDelegator->delegate($entry, $closure);
            } else {
                return $this->entryDelegator->delegate($entry, $closure);
            }
        });
    }
}

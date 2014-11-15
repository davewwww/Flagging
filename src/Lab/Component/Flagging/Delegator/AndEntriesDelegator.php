<?php

namespace Lab\Component\Flagging\Delegator;

/**
 * @author David Wolter <david@dampfer.net>
 */
class AndEntriesDelegator implements EntriesDelegatorInterface
{
    /**
     * @var EntryDelegatorInterface
     */
    protected $entryDelegator;

    /**
     * @param EntryDelegatorInterface $entryDelegator
     */
    function __construct(EntryDelegatorInterface $entryDelegator)
    {
        $this->entryDelegator = $entryDelegator;
    }

    /**
     * {@inheritdoc}
     */
    public function delegate(array $entries, \Closure $closure)
    {
        foreach ($entries as $value) {
            if (!$this->entryDelegator->delegate($value, $closure)) {
                return false;
            }
        }

        return true;
    }
}

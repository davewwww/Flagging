<?php

namespace Lab\Component\Flagging\Delegator;

/**
 * @author David Wolter <david@dampfer.net>
 */
class AndOrEntriesDelegator implements EntriesDelegatorInterface
{
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
     * {@inheritdoc}
     */
    public function delegate(array $entries, \Closure $closure)
    {
        return $this->andDelegator->delegate(
            $entries,
            function ($entry) use ($closure) {
                if (is_array($entry)) {
                    return $this->orDelegator->delegate($entry, $closure);
                } else {
                    return $this->entryDelegator->delegate($entry, $closure);
                }
            }
        );
    }
}

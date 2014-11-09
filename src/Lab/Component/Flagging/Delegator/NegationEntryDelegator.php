<?php

namespace Lab\Component\Flagging\Delegator;


/**
 * @author David Wolter <david@dampfer.net>
 */
class NegationEntryDelegator implements EntryDelegatorInterface
{
    /**
     * @param string   $entry
     * @param callable $closure
     *
     * @return bool
     */
    public function delegate($entry, \Closure $closure)
    {
        $negated = $this->isNegated($entry);
        $result = $closure($entry);

        return $negated !== $result ? ($negated ? !$result : $result) : false;
    }

    /**
     * @param string $property
     *
     * @return bool
     */
    protected function isNegated(&$property)
    {
        return $property[0] === '!' && $property = substr($property, 1);
    }
}

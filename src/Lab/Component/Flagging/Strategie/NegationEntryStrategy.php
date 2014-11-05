<?php

namespace Lab\Component\Flagging\Strategie;

/**
 * @author David Wolter <david@dampfer.net>
 */
class NegationEntryStrategy implements DecideEntryStrategyInterface
{
    /**
     * @param string   $entry
     * @param callable $closure
     *
     * @return bool
     */
    public function decide($entry, \Closure $closure)
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

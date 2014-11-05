<?php

namespace Lab\Component\Flagging\Strategie;

/**
 * @author David Wolter <david@dampfer.net>
 */
class AndWalkEntriesStrategy implements WalkEntriesStrategyInterface
{
    /**
     * @var DecideEntryStrategyInterface
     */
    protected $decideStragety;

    /**
     * @param DecideEntryStrategyInterface $decideStragety
     */
    function __construct(DecideEntryStrategyInterface $decideStragety)
    {
        $this->decideStragety = $decideStragety;
    }

    /**
     * @param array    $entries
     * @param callable $closure
     *
     * @return bool
     */
    public function walk($entries, \Closure $closure)
    {
        foreach ($entries as $value) {
            if (!$this->decideStragety->decide($value, $closure)) {
                return false;
            }
        }

        return true;
    }
}

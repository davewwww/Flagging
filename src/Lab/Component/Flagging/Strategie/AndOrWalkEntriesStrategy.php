<?php

namespace Lab\Component\Flagging\Strategie;

/**
 * @author David Wolter <david@dampfer.net>
 */
class AndOrWalkEntriesStrategy implements WalkEntriesStrategyInterface
{
    /**
     * @var WalkEntriesStrategyInterface
     */
    protected $andWalker;

    /**
     * @var WalkEntriesStrategyInterface
     */
    protected $orWalker;

    /**
     * @var DecideEntryStrategyInterface
     */
    protected $decideStragety;

    /**
     * @param array    $entries
     * @param callable $closure
     *
     * @return bool
     */
    public function walk($entries, \Closure $closure)
    {
        return $this->andWalker->walk($entries, function ($entry) use ($closure) {
            if (is_array($entry)) {
                return $this->orWalker->walk($entry, $closure);
            } else {
                return $this->decideStragety->decide($entry, $closure);
            }
        });
    }
}

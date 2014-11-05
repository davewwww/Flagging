<?php

namespace Lab\Component\Flagging\Decider;

use Lab\Component\Flagging\Strategie\WalkEntriesStrategyInterface;
use Lab\Component\Flagging\VoteContext;
use Symfony\Component\VarDumper\VarDumper;

/**
 * @author David Wolter <david@dampfer.net>
 */
class FilterDecider implements EntriesDeciderInterface
{
    /**
     * @var WalkEntriesStrategyInterface
     */
    protected $walkStrategy;

    /**
     * @var EntriesDeciderInterface
     */
    protected $voterDecider;

    /**
     * @param WalkEntriesStrategyInterface $walkStrategy
     * @param EntriesDeciderInterface $voterDecider
     */
    function __construct(WalkEntriesStrategyInterface $walkStrategy, EntriesDeciderInterface $voterDecider)
    {
        $this->walkStrategy = $walkStrategy;
        $this->voterDecider = $voterDecider;
    }

    /**
     * @param array $entries
     * @param VoteContext $token
     *
     * @return bool
     */
    public function decide(array $entries, VoteContext $token)
    {
        if (!empty($entries)) {
            return $this->walkStrategy->walk($entries, function ($voters) use ($token) {
                return $this->voterDecider->decide($voters, $token);
            });
        } else {
            return true;
        }
    }
}

<?php

namespace Dwo\Flagging\Voter;

use Dwo\Flagging\Context\Context;
use Dwo\Flagging\Exception\FlaggingException;
use Dwo\Flagging\Model\FilterInterface;

/**
 * @author Dave Www <davewwwo@gmail.com>
 */
class CachedFilterVoter implements VoterInterface
{
    /**
     * @var FilterVoter
     */
    protected $filterVoter;

    /**
     * @param FilterVoter $filterVoter
     */
    public function __construct(FilterVoter $filterVoter)
    {
        $this->filterVoter = $filterVoter;
    }

    /**
     * @param FilterInterface $config
     * @param Context         $context
     *
     * @return bool
     *
     * @throws FlaggingException
     */
    public function vote($config, Context $context)
    {
        if (!$config instanceof FilterInterface) {
            throw new FlaggingException(
                sprintf('%s parameter must be FilterInterface in %s, %s given', '$config', __CLASS__, gettype($config))
            );
        }

        if (null === $result = $context->getResultCache()->getResult((string) $config)) {
            $context->getResultCache()->addResult(
                (string) $config,
                $result = $this->filterVoter->vote($config, $context)
            );
        }

        return $result;
    }
}

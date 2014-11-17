<?php

namespace Lab\Component\Flagging\Voter;

use Lab\Component\Flagging\Context\Context;
use Lab\Component\Flagging\Exception\FlaggingException;
use Lab\Component\Flagging\Model\FilterInterface;

/**
 * @author David Wolter <david@dampfer.net>
 */
class CachedFilterVoter implements VoterInterface
{
    /**
     * @var VoterInterface
     */
    protected $filterVoter;

    /**
     * @var string
     */
    protected $name;

    /**
     * @param VoterInterface $filterVoter
     * @param string         $name
     */
    function __construct($filterVoter, $name = "cached_filter")
    {
        $this->filterVoter = $filterVoter;
        $this->name = $name;
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return $this->name;
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

        if (null === $result = $context->getResultCache()->getResult((string)$config)) {
            $context->getResultCache()->addResult(
                (string)$config,
                $result = $this->filterVoter->vote($config, $context)
            );
        }

        return $result;
    }
}

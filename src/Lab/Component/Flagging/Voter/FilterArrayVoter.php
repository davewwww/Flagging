<?php

namespace Lab\Component\Flagging\Voter;

use Lab\Component\Flagging\Context\Context;
use Lab\Component\Flagging\Model\Filter;

/**
 * @author David Wolter <david@dampfer.net>
 */
class FilterArrayVoter implements VoterInterface
{
    const NAME = 'filter_array';

    /**
     * @var VoterInterface
     */
    protected $filterVoter;

    /**
     * @param VoterInterface $filterVoter
     */
    function __construct(VoterInterface $filterVoter)
    {
        $this->filterVoter = $filterVoter;
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return self::NAME;
    }

    /**
     * @param array   $config
     * @param Context $context
     *
     * @return bool
     */
    public function vote($config, Context $context)
    {
        foreach ($config as $key => $value) {
            $config[$key] = new Filter($key, $value);
        }

        return $this->filterVoter->vote($config, $context);
    }
}

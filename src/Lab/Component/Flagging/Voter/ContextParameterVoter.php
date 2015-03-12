<?php

namespace Lab\Component\Flagging\Voter;

use Lab\Component\Flagging\Context\Context;
use Lab\Component\Flagging\Delegator\EntriesDelegatorInterface;

/**
 * @author David Wolter <david@dampfer.net>
 */
class ContextParameterVoter implements VoterInterface
{
    /**
     * @var EntriesDelegatorInterface
     */
    protected $delegetor;
    /**
     * @var string
     */
    protected $name;
    /**
     * @var string
     */
    protected $parameterKey;

    /**
     * @param EntriesDelegatorInterface $delegetor
     * @param string                    $name
     * @param string                    $parameterKey
     */
    function __construct(EntriesDelegatorInterface $delegetor, $name, $parameterKey)
    {
        $this->delegetor = $delegetor;
        $this->name = $name;
        $this->parameterKey = $parameterKey;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed   $config
     * @param Context $context
     *
     * @return Boolean
     */
    public function vote($config, Context $context)
    {
        return $this->delegetor->delegate(
            $config,
            function ($entry) use ($context) {
                return $entry === $context->getParam($this->parameterKey);
            }
        );
    }
}

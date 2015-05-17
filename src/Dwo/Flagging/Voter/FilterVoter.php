<?php

namespace Dwo\Flagging\Voter;

use Dwo\Flagging\Context\Context;
use Dwo\Flagging\Exception\FlaggingException;
use Dwo\Flagging\Model\FilterInterface;
use Dwo\Flagging\Model\VoterManagerInterface;

/**
 * @author David Wolter <david@lovoo.com>
 */
class FilterVoter implements VoterInterface
{
    /**
     * @var VoterManagerInterface
     */
    protected $voterManager;

    /**
     * @param VoterManagerInterface $voterManager
     */
    public function __construct(VoterManagerInterface $voterManager)
    {
        $this->voterManager = $voterManager;
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

        return $this->voterManager->getVoter($config->getName())->vote($config->getParameter(), $context);
    }
}

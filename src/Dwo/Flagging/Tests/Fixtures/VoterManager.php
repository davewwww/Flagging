<?php

namespace Dwo\Flagging\Tests\Fixtures;

use Dwo\Flagging\Exception\FlaggingException;
use Dwo\Flagging\Model\VoterManagerInterface;
use Dwo\Flagging\Voter\VoterInterface;

class VoterManager implements VoterManagerInterface
{
    /**
     * @var VoterInterface[]
     */
    protected $voter;

    /**
     * @param VoterInterface[] $voter
     */
    public function __construct(array $voter)
    {
        $this->voter = $voter;
    }

    /**
     * {@inheritdoc}
     */
    public function getVoter($name)
    {
        if (!isset($this->voter[$name])) {
            throw new FlaggingException(sprintf('voter "%s" not found', $name));
        }

        return $this->voter[$name];
    }

    /**
     * {@inheritdoc}
     */
    public function getAllVoters()
    {
        return $this->voter;
    }
}
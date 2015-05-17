<?php

namespace Dwo\Flagging\Model;

use Dwo\Flagging\Exception\FlaggingException;
use Dwo\Flagging\Voter\VoterInterface;

/**
 * @author David Wolter <david@lovoo.com>
 */
interface VoterManagerInterface
{
    /**
     * @param string $name
     *
     * @throws FlaggingException
     *
     * @return VoterInterface
     */
    public function getVoter($name);
}
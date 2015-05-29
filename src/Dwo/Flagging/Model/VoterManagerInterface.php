<?php

namespace Dwo\Flagging\Model;

use Dwo\Flagging\Exception\FlaggingException;
use Dwo\Flagging\Voter\VoterInterface;

/**
 * @author Dave Www <davewwwo@gmail.com>
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
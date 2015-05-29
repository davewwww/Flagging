<?php

namespace Dwo\Flagging\Voter;

use Dwo\Flagging\Context\Context;

/**
 * @author Dave Www <davewwwo@gmail.com>
 */
interface VoterInterface
{
    /**
     * @param mixed   $config
     * @param Context $context
     *
     * @return Boolean
     */
    public function vote($config, Context $context);
}

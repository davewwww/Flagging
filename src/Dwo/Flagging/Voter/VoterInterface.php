<?php

namespace Dwo\Flagging\Voter;

use Dwo\Flagging\Context\Context;

/**
 * @author David Wolter <david@lovoo.com>
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

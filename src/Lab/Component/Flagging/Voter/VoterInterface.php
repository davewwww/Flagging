<?php

namespace Lab\Component\Flagging\Voter;

use Lab\Component\Flagging\Context\Context;

/**
 * @author David Wolter <david@dampfer.net>
 */
interface VoterInterface
{
    /**
     * @return string
     */
    function getName();

    /**
     * @param mixed   $config
     * @param Context $context
     *
     * @return Boolean
     */
    function vote($config, Context $context);
}

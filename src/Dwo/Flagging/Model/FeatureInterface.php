<?php

namespace Dwo\Flagging\Model;

/**
 * @author Dave Www <davewwwo@gmail.com>
 */
interface FeatureInterface extends NameInterface
{
    /**
     * @return FilterBagInterface
     */
    public function getFilter();

    /**
     * @return FilterBagInterface
     */
    public function getBreaker();

    /**
     * @return ValueBagInterface
     */
    public function getValue();

    /**
     * @return bool
     */
    public function isEnabled();

    /**
     * @param bool $enabled
     */
    public function setEnabled($enabled);
}
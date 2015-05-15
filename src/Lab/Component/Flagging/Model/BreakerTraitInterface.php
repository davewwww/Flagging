<?php

namespace Lab\Component\Flagging\Model;

/**
 * @author David Wolter <david@dampfer.net>
 */
interface BreakerTraitInterface
{
    /**
     * @return null|FilterCollectionInterface[]
     */
    public function getBreaker();

    /**
     * @param null|FilterCollectionInterface[] $breaker
     */
    public function setBreaker(array $breaker = null);

    /**
     * @param FilterCollectionInterface $breaker
     */
    public function addBreaker(FilterCollectionInterface $breaker);
}
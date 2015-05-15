<?php

namespace Lab\Component\Flagging\Model;

/**
 * @author David Wolter <david@dampfer.net>
 */
trait BreakerTrait
{
    /**
     * @var null|FilterCollectionInterface[]
     */
    protected $breaker;

    /**
     * @return null|FilterCollectionInterface[]
     */
    public function getBreaker()
    {
        return $this->breaker;
    }

    /**
     * @param null|FilterCollectionInterface[] $breaker
     */
    public function setBreaker(array $breaker = null)
    {
        $this->breaker = $breaker;
    }

    /**
     * @param FilterCollectionInterface $breaker
     */
    public function addBreaker(FilterCollectionInterface $breaker)
    {
        $this->breaker[] = $breaker;
    }
}
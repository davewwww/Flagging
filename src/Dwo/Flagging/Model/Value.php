<?php

namespace Dwo\Flagging\Model;

/**
 * @author Dave Www <davewwwo@gmail.com>
 */
class Value implements ValueInterface
{
    /**
     * @var FilterBagInterface
     */
    protected $filter;

    /**
     * @var mixed
     */
    protected $value;

    /**
     * @var bool
     */
    protected $isFeature;

    /**
     * @param mixed                   $value
     * @param FilterBagInterface|null $filter
     * @param bool                    $isFeature
     */
    public function __construct($value, FilterBagInterface $filter = null, $isFeature = false)
    {
        $this->value = $value;
        $this->filter = $filter ?: new FilterBag();
        $this->isFeature = (bool) $isFeature;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @return FilterBagInterface
     */
    public function getFilter()
    {
        return $this->filter;
    }

    /**
     * @return bool
     */
    public function isFeature()
    {
        return $this->isFeature;
    }
}
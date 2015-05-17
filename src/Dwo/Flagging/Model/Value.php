<?php

namespace Dwo\Flagging\Model;

/**
 * @author David Wolter <david@lovoo.com>
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
     * @param mixed                   $value
     * @param FilterBagInterface|null $filter
     */
    public function __construct($value, FilterBagInterface $filter = null)
    {
        $this->value = $value;
        $this->filter = $filter ?: new FilterBag();
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
}
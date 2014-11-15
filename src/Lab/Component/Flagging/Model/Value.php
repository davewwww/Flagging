<?php

namespace Lab\Component\Flagging\Model;

/**
 * @author David Wolter <david@dampfer.net>
 */
class Value implements ValueInterface
{
    use FiltersTrait;

    /**
     * @var mixed
     */
    protected $value;

    /**
     * @param mixed                       $value
     * @param FilterCollectionInterface[] $filters
     */
    function __construct($value, array $filters = null)
    {
        $this->value = $value;
        $this->setFilters($filters);
    }

    /**
     * @return mixed
     */
    function getValue()
    {
        return $this->value;
    }
}
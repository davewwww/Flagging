<?php

namespace Lab\Component\Flagging\Model;

/**
 * @author David Wolter <david@dampfer.net>
 */
class Value implements ValueInterface {

    protected $value;
    protected $filters;

    /**
     * @param array $filters
     * @param $value
     */
    function __construct($value, array $filters = null) {
        $this->value = $value;
        $this->filters = $filters;
    }

    /**
     * @return array
     */
    function getFilters() {
        return $this->filters;
    }

    /**
     * @return mixed
     */
    function getValue() {
        return $this->value;
    }
}
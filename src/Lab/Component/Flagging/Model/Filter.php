<?php

namespace Lab\Component\Flagging\Model;

/**
 * @author David Wolter <david@dampfer.net>
 */
class Filter implements FilterInterface {
    protected $name;
    protected $parameter;

    function __construct($name, $parameter = null) {
        $this->name = $name;
        $this->parameter = $parameter;
    }

    /**
     * @return mixed
     */
    public function getName() {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name) {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getParameter() {
        return $this->parameter;
    }

    /**
     * @param mixed $parameter
     */
    public function setParameter($parameter) {
        $this->parameter = $parameter;
    }
}
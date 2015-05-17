<?php

namespace Dwo\Flagging\Context;

/**
 * @author David Wolter <david@lovoo.com>
 */
class ResultCache
{
    /**
     * @var array
     */
    protected $results;

    /**
     * @param string $id
     *
     * @return Boolean|null
     */
    public function getResult($id)
    {
        return isset($this->results[$id]) ? $this->results[$id] : null;
    }

    /**
     * @param string  $id
     * @param Boolean $result
     */
    public function addResult($id, $result)
    {
        $this->results[$id] = $result;
    }
}

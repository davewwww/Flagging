<?php

namespace Dwo\Flagging\Model;

/**
 * @author Dave Www <davewwwo@gmail.com>
 */
class ValueBag implements ValueBagInterface
{
    /**
     * @var ValueInterface[]
     */
    protected $values;

    /**
     * @param ValueInterface[] $values
     */
    public function __construct(array $values = array())
    {
        $this->values = $values;
    }

    /**
     * @return ValueInterface[]
     */
    public function getValues()
    {
        return $this->values;
    }
}
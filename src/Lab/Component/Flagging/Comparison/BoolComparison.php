<?php

namespace Lab\Component\Flagging\Comparison;

/**
 * @author David Wolter <david@dampfer.net>
 */
class BoolComparison implements ComparisonInterface
{
    const NAME = "bool";

    /**
     * @return \Closure[]
     */
    function getAllComparisons()
    {
        return array(
            self::NAME => function ($a, $b) {
                    return self::boolval($a) === self::boolval($b);
                }
        );
    }

    /**
     * {@inheritDoc}
     */
    function getComparison($key)
    {
        return $this->getAllComparisons()[self::NAME];
    }

    /**
     * @param mixed $value
     *
     * @return bool
     */
    private static function boolval($value)
    {
        if (empty($value) OR !is_scalar($value)) {
            return false;
        }

        if (is_numeric($value)) {
            return (boolean)(int)$value;
        }

        if ($value === "false") {
            return false;
        }

        return true;
    }

}

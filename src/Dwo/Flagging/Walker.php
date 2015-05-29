<?php

namespace Dwo\Flagging;

use Dwo\Flagging\Exception\FlaggingException;

/**
 * @author Dave Www <davewwwo@gmail.com>
 */
class Walker
{
    const WALK_AND = 'and';
    const WALK_OR = 'or';

    /**
     * @param array    $entries
     * @param callable $closure
     * @param string   $walkType
     * @param bool     $negated
     *
     * @return bool
     *
     * @throws FlaggingException
     */
    public static function walk(array $entries, \Closure $closure, $walkType = self::WALK_AND, $negated = false)
    {
        switch ($walkType) {
            case self::WALK_OR:
                return self::walkOr($entries, $closure, $negated);

            case self::WALK_AND:
                return self::walkAnd($entries, $closure, $negated);
        }

        throw new FlaggingException(sprintf('unknow walk type "%s"', $walkType));
    }

    /**
     * @param array    $entries
     * @param callable $closure
     * @param bool     $negated
     *
     * @return bool
     */
    public static function walkOr(array $entries, \Closure $closure, $negated = false)
    {
        foreach ($entries as $value) {
            if (self::delegate($value, $closure, $negated)) {
                return true;
            }
        }

        return false;
    }

    /**
     * @param array    $entries
     * @param callable $closure
     * @param bool     $negated
     *
     * @return bool
     */
    public static function walkAnd(array $entries, \Closure $closure, $negated = false)
    {
        foreach ($entries as $value) {
            if (!self::delegate($value, $closure, $negated)) {
                return false;
            }
        }

        return true;
    }

    /**
     * @param mixed    $entry
     * @param callable $closure
     * @param bool     $negated
     *
     * @return bool
     */
    public static function delegate($entry, \Closure $closure, $negated = false)
    {
        return $negated ? self::delegateNegated($entry, $closure) : $closure($entry);
    }

    /**
     * @param          $entry
     * @param callable $closure
     *
     * @return bool
     */
    public static function delegateNegated($entry, \Closure $closure)
    {
        $isNegated = function (&$property) {
            return $property[0] === '!' && $property = substr($property, 1);
        };

        $negated = is_scalar($entry) ? $isNegated($entry) : false;
        $result = $closure($entry);

        return $negated !== $result ? ($negated ? !$result : $result) : false;
    }
}

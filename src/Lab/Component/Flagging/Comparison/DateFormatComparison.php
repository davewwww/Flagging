<?php

namespace Lab\Component\Flagging\Comparison;

/**
 * @author David Wolter <david@dampfer.net>
 */
class DateFormatComparison implements ComparisonInterface
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $format;

    /**
     * @param string $name
     * @param string $format
     */
    public function __construct($name, $format = "Y-m-d")
    {
        $this->name = $name;
        $this->format = $format;
    }

    /**
     * {@inheritDoc}
     */
    function getAllComparisons()
    {
        return array(
            $this->name => function ($a, $b) {
                    if ($a instanceof \DateTime) {
                        $a = $a->format($this->format);
                    }
                    if ($b instanceof \DateTime) {
                        $b = $b->format($this->format);
                    }

                    return $a === $b;
                }
        );
    }

    /**
     * {@inheritDoc}
     */
    function getComparison($key = null)
    {
        return $this->getAllComparisons()[$this->name];
    }

}

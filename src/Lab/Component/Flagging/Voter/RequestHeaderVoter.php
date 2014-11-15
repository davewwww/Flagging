<?php

namespace Lab\Component\Flagging\Voter;

use Lab\Component\Flagging\Comparison\ComparisonInterface;
use Lab\Component\Flagging\Context\Context;

/**
 * :TODO: refactor!
 * @author David Wolter <david@dampfer.net>
 */
class RequestHeaderVoter implements VoterInterface
{
    /**
     * @var ComparisonInterface
     */
    private $comparison;
    /**
     * @var string
     */
    private $header;
    /**
     * @var string
     */
    private $name;
    /**
     * @var string
     */
    private $compareType;

    /**
     * Constructor.
     *
     * @param ComparisonInterface $comparison
     * @param string              $header
     * @param string              $name
     * @param string              $nullValue
     * @param string|null         $compareType
     */
    public function __construct(
        ComparisonInterface $comparison,
        $header,
        $name = "request_header",
        $nullValue = null,
        $compareType = null
    ) {
        $this->comparison = $comparison;
        $this->header = $header;
        $this->name = $name;
        $this->nullValue = $nullValue;
        $this->compareType = $compareType;
    }

    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * {@inheritDoc}
     */
    public function vote($config, Context $context)
    {
        $properties = $context->getParams();

        if (isset($_SERVER[$this->header])) {
            $value = $_SERVER[$this->header];
        } elseif (isset($properties["server"]) && isset($properties["server"][$this->header])) {
            $value = $properties["server"][$this->header];
        } else {
            $value = $this->nullValue;
        }

        $closure = $this->comparison->getComparison($this->compareType);

        return $closure($config, $value);
    }
}

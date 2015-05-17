<?php

namespace Dwo\Flagging\Model;

/**
 * @author David Wolter <david@lovoo.com>
 */
class Feature implements FeatureInterface
{
    use NameTrait;

    /**
     * @var FilterBagInterface
     */
    protected $filter;

    /**
     * @var FilterBagInterface
     */
    protected $breaker;

    /**
     * @var ValueBagInterface
     */
    protected $value;

    /**
     * @var bool
     */
    protected $enabled = true;

    /**
     * @param string                  $name
     * @param FilterBagInterface|null $filter
     * @param FilterBagInterface|null $breaker
     * @param ValueBagInterface|null  $values
     */
    public function __construct(
        $name,
        FilterBagInterface $filter = null,
        FilterBagInterface $breaker = null,
        ValueBagInterface $values = null
    ) {
        $this->name = $name;
        $this->filter = $filter ?: new FilterBag();
        $this->breaker = $breaker ?: new FilterBag();
        $this->value = $values ?: new ValueBag();
    }

    /**
     * @return FilterBagInterface
     */
    public function getFilter()
    {
        return $this->filter;
    }

    /**
     * @return FilterBagInterface
     */
    public function getBreaker()
    {
        return $this->breaker;
    }

    /**
     * @return ValueBagInterface
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * {@inheritdoc}
     */
    public function isEnabled()
    {
        return $this->enabled;
    }

    /**
     * {@inheritdoc}
     */
    public function setEnabled($enabled)
    {
        $this->enabled = $enabled;
    }
}
<?php

namespace Dwo\Flagging\Tests\Fixtures;

use Dwo\Flagging\Exception\FlaggingException;
use Dwo\Flagging\Model\FeatureInterface;
use Dwo\Flagging\Model\FeatureManagerInterface;

class FeatureManager implements FeatureManagerInterface
{
    /**
     * @var FeatureInterface[]
     */
    protected $feature;

    /**
     * @param FeatureInterface[] $feature
     */
    public function __construct(array $feature)
    {
        $this->feature = $feature;
    }

    /**
     * @param string $name
     *
     * @return FeatureInterface
     */
    public function findFeatureByName($name)
    {
        if (!isset($this->feature[$name])) {
            throw new FlaggingException(sprintf('feature "%s" not found', $name));
        }

        return $this->feature[$name];
    }

    /**
     * @return FeatureInterface[]
     */
    public function findAllFeatures()
    {
        return $this->feature;
    }

    /**
     * @param FeatureInterface $feature
     */
    public function saveFeature(FeatureInterface $feature)
    {
        $this->feature[$feature->getName()] = $feature;
    }
}
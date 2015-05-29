<?php

namespace Dwo\Flagging\Validator;

use Dwo\Flagging\Model\VoterManagerInterface;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

/**
 * Class VotersExistsValidator
 *
 * @author Dave Www <davewwwo@gmail.com>
 */
class VotersExistsValidator extends ConstraintValidator
{
    /**
     * @var VoterManagerInterface
     */
    protected $voterManager;

    /**
     * @param VoterManagerInterface $voterManager
     */
    public function __construct(VoterManagerInterface $voterManager)
    {
        $this->voterManager = $voterManager;
    }

    /**
     * @param mixed                   $value
     * @param VotersExists|Constraint $constraint
     */
    public function validate($value, Constraint $constraint)
    {
        $votersDiff = array_diff(
            $this->extractAllVoters($value),
            array_keys($this->voterManager->getAllVoters())
        );

        if (count($votersDiff)) {
            $v = implode(', ', $votersDiff);
            $this->context->addViolation(sprintf('Unknown Voter: %s', $v));
        }
    }

    /**
     * @param $value
     *
     * @return array
     */
    protected function extractAllVoters($value)
    {
        /**
         * @param array $filters
         *
         * @return array
         */
        $extractVoters = function (array $filters) {
            $voters = [];
            foreach ($filters as $filter) {
                $voters = array_merge($voters, array_keys($filter));
            }

            return array_unique($voters);
        };

        $voters = [];
        if (isset($value['filters'])) {
            $voters = array_merge($voters, $extractVoters($value['filters']));
        }
        if (isset($value['breaker'])) {
            $voters = array_merge($voters, $extractVoters($value['breaker']));
        }
        if (isset($value['values'])) {
            foreach ($value['values'] as $valueValue) {
                if (isset($valueValue['filters'])) {
                    $voters = array_merge($voters, $extractVoters($valueValue['filters']));
                }
            }
        }

        return array_unique($voters);
    }
}

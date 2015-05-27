<?php

namespace Dwo\Flagging\Validator;

use Symfony\Component\Validator\Constraint;

/**
 * Class VotersExists
 *
 * @author David Wolter <david@lovoo.com>
 */
class VotersExists extends Constraint
{
    /**
     * @return string
     */
    public function validatedBy()
    {
        return 'voters_exists';
    }

    /**
     * @return string
     */
    public function getTargets()
    {
        return self::PROPERTY_CONSTRAINT;
    }
}

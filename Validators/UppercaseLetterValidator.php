<?php

namespace Piwik\Plugins\PasswordPolicyEnforcer\Validators;

use Piwik\Piwik;

class UppercaseLetterValidator implements ValidatorInterface
{
    public function validate($value)
    {
        if (!preg_match('/[A-Z]/', $value)) {
            throw new ValidationException('PasswordPolicyEnforcer_ExceptionInvalidPasswordUppercaseLetterRequired');
        }

        return true;
    }
}

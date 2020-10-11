<?php

namespace Piwik\Plugins\PasswordPolicyEnforcer\Validators;


class LowercaseLetterValidator implements ValidatorInterface
{
    public function validate($value)
    {
        if (!preg_match('/[a-z]/', $value)) {
            throw new ValidationException('PasswordPolicyEnforcer_ExceptionInvalidPasswordLowercaseLetterRequired');
        }

        return true;
    }
}

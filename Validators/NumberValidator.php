<?php

namespace Piwik\Plugins\PasswordPolicyEnforcer\Validators;

class NumberValidator implements ValidatorInterface
{
    public function validate($value)
    {
        if (!preg_match('/[0-9]/', $value)) {
            throw new ValidationException('PasswordPolicyEnforcer_ExceptionInvalidPasswordNumberRequired');
        }

        return true;
    }
}
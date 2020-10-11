<?php

namespace Piwik\Plugins\PasswordPolicyEnforcer\Validators;

class SpecialCharacterValidator implements ValidatorInterface
{
    public function validate($value)
    {
        if (!preg_match('/[^a-zA-Z0-9]/', $value)) {
            throw new ValidationException('PasswordPolicyEnforcer_ExceptionInvalidPasswordSpecialCharacterRequired');
        }

        return true;
    }
}

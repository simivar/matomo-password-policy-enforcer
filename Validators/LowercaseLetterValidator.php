<?php

declare(strict_types=1);

namespace Piwik\Plugins\PasswordPolicyEnforcer\Validators;

class LowercaseLetterValidator implements ValidatorInterface
{
    public function validate(string $value): bool
    {
        if (!preg_match('/[a-z]/', $value)) {
            throw new ValidationException('PasswordPolicyEnforcer_ExceptionInvalidPasswordLowercaseLetterRequired');
        }

        return true;
    }
}

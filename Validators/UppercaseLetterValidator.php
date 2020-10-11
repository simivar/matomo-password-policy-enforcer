<?php

declare(strict_types=1);

namespace Piwik\Plugins\PasswordPolicyEnforcer\Validators;

class UppercaseLetterValidator implements ValidatorInterface
{
    public function validate(string $value): bool
    {
        if (!preg_match('/[A-Z]/', $value)) {
            throw new ValidationException('PasswordPolicyEnforcer_ExceptionInvalidPasswordUppercaseLetterRequired');
        }

        return true;
    }
}

<?php

declare(strict_types=1);

namespace Piwik\Plugins\PasswordPolicyEnforcer\Validators;

class SpecialCharacterValidator implements ValidatorInterface
{
    public function validate(string $value): bool
    {
        if (!preg_match('/[^a-zA-Z0-9]/', $value)) {
            throw new ValidationException('PasswordPolicyEnforcer_ExceptionInvalidPasswordSpecialCharacterRequired');
        }

        return true;
    }
}

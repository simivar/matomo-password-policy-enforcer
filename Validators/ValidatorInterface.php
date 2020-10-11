<?php

namespace Piwik\Plugins\PasswordPolicyEnforcer\Validators;

interface ValidatorInterface
{
    /**
     * @throws ValidationException
     */
    public function validate(string $value): bool;
}

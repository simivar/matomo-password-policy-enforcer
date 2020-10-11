<?php

namespace Piwik\Plugins\PasswordPolicyEnforcer\Validators;

class MinimumLengthValidator implements ValidatorInterface
{
    private $minLength;

    public function __construct(int $minLength = 6)
    {
        $this->minLength = $minLength;
    }

    public function validate(string $value): bool
    {
        if (mb_strlen($value) < $this->minLength) {
            throw new ValidationException('UsersManager_ExceptionInvalidPassword', [$this->minLength]);
        }

        return true;
    }
}

<?php

declare(strict_types=1);

namespace Piwik\Plugins\PasswordPolicyEnforcer\Validators;

class MinimumLengthValidator implements ValidatorInterface
{
    /** @var int */
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

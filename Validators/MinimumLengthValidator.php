<?php

namespace Piwik\Plugins\PasswordPolicyEnforcer\Validators;

class MinimumLengthValidator implements ValidatorInterface
{
    /** @var int */
    private $minLength;

    public function __construct($minLength = 6)
    {
        $this->minLength = (int) $minLength;
    }

    public function validate($value)
    {
        if (mb_strlen($value) < $this->minLength) {
            throw new ValidationException('UsersManager_ExceptionInvalidPassword', [$this->minLength]);
        }

        return true;
    }
}
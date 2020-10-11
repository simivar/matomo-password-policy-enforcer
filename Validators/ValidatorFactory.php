<?php

namespace Piwik\Plugins\PasswordPolicyEnforcer\Validators;

use Piwik\Plugins\PasswordPolicyEnforcer\SystemSettings;

class ValidatorFactory
{
    private $passwordValidator;

    public function __construct(PasswordValidator $passwordValidator)
    {
        $this->passwordValidator = $passwordValidator;
    }

    public function create(SystemSettings $settings): PasswordValidator
    {
        $this->passwordValidator->addValidator(new MinimumLengthValidator($settings->minLength->getValue()));

        if ($settings->isOneUppercaseLetterRequired->getValue()) {
            $this->passwordValidator->addValidator(new UppercaseLetterValidator());
        }

        if ($settings->isOneLowercaseLetterRequired->getValue()) {
            $this->passwordValidator->addValidator(new LowercaseLetterValidator());
        }

        if ($settings->isOneNumberRequired->getValue()) {
            $this->passwordValidator->addValidator(new NumberValidator());
        }

        if ($settings->isOneSpecialCharacterRequired->getValue()) {
            $this->passwordValidator->addValidator(new SpecialCharacterValidator());
        }

        return $this->passwordValidator;
    }
}

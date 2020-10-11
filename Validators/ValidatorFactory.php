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

    /**
     * @psalm-suppress MissingDependency
     */
    public function create(SystemSettings $settings): PasswordValidator
    {
        /** @psalm-suppress UndefinedDocblockClass */
        $this->passwordValidator->addValidator(new MinimumLengthValidator($settings->minLength->getValue()));

        /** @psalm-suppress UndefinedDocblockClass */
        if ($settings->isOneUppercaseLetterRequired->getValue()) {
            $this->passwordValidator->addValidator(new UppercaseLetterValidator());
        }

        /** @psalm-suppress UndefinedDocblockClass */
        if ($settings->isOneLowercaseLetterRequired->getValue()) {
            $this->passwordValidator->addValidator(new LowercaseLetterValidator());
        }

        /** @psalm-suppress UndefinedDocblockClass */
        if ($settings->isOneNumberRequired->getValue()) {
            $this->passwordValidator->addValidator(new NumberValidator());
        }

        /** @psalm-suppress UndefinedDocblockClass */
        if ($settings->isOneSpecialCharacterRequired->getValue()) {
            $this->passwordValidator->addValidator(new SpecialCharacterValidator());
        }

        return $this->passwordValidator;
    }
}

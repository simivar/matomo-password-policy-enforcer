<?php

declare(strict_types=1);

namespace Piwik\Plugins\PasswordPolicyEnforcer\Validators;

use Piwik\Plugins\PasswordPolicyEnforcer\SystemSettings;

class ValidatorFactory
{
    /** @var PasswordValidator */
    private $passwordValidator;

    public function __construct(PasswordValidator $passwordValidator)
    {
        $this->passwordValidator = $passwordValidator;
    }

    /**
     * @psalm-suppress MissingDependency
     * @phpstan-ignore-next-line
     */
    public function create(SystemSettings $settings): PasswordValidator
    {
        /**
         * @psalm-suppress UndefinedDocblockClass
         * @phpstan-ignore-next-line
         */
        $this->passwordValidator->addValidator(new MinimumLengthValidator($settings->minLength->getValue()));

        /**
         * @psalm-suppress UndefinedDocblockClass
         * @phpstan-ignore-next-line
         */
        if ($settings->isOneUppercaseLetterRequired->getValue()) {
            $this->passwordValidator->addValidator(new UppercaseLetterValidator());
        }

        /**
         * @psalm-suppress UndefinedDocblockClass
         * @phpstan-ignore-next-line
         */
        if ($settings->isOneLowercaseLetterRequired->getValue()) {
            $this->passwordValidator->addValidator(new LowercaseLetterValidator());
        }

        /**
         * @psalm-suppress UndefinedDocblockClass
         * @phpstan-ignore-next-line
         */
        if ($settings->isOneNumberRequired->getValue()) {
            $this->passwordValidator->addValidator(new NumberValidator());
        }

        /**
         * @psalm-suppress UndefinedDocblockClass
         * @phpstan-ignore-next-line
         */
        if ($settings->isOneSpecialCharacterRequired->getValue()) {
            $this->passwordValidator->addValidator(new SpecialCharacterValidator());
        }

        return $this->passwordValidator;
    }
}

<?php

namespace Piwik\Plugins\PasswordPolicyEnforcer;

use Piwik\Piwik;
use Piwik\Plugin;
use Piwik\Plugins\PasswordPolicyEnforcer\Validators\PasswordValidator;
use Piwik\Plugins\PasswordPolicyEnforcer\Validators\ValidationException;

class PasswordPolicyEnforcer extends Plugin
{
    public function registerEvents() {
        return array(
            'UsersManager.checkPassword' => 'verifyPassword'
        );
    }

    public function verifyPassword($password) {
        $settings = new SystemSettings();
        $passwordValidator = new PasswordValidator(
            $settings->minLength->getValue(),
            $settings->isOneUppercaseLetterRequired->getValue(),
            $settings->isOneLowercaseLetterRequired->getValue(),
            $settings->isOneNumberRequired->getValue(),
            $settings->isOneNumberRequired->getValue()
        );

        try {
            return $passwordValidator->validate($password);
        } catch (ValidationException $exception) {
            throw new ValidationException(
                Piwik::translate($exception->getMessage(), $exception->getTranslationParams())
            );
        }
    }
}

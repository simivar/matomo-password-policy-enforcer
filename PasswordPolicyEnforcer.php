<?php

namespace Piwik\Plugins\PasswordPolicyEnforcer;

use Piwik\Plugins\PasswordPolicyEnforcer\Validators\PasswordValidator;

class PasswordPolicyEnforcer extends \Piwik\Plugin
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
    
        return $passwordValidator->validate($password);
    }
    
}

<?php

namespace Piwik\Plugins\PasswordPolicyEnforcer;

use Piwik\Container\StaticContainer;
use Piwik\Plugin;
use Piwik\Plugins\PasswordPolicyEnforcer\Validators\ValidatorFactory;

class PasswordPolicyEnforcer extends Plugin
{
    public function registerEvents() {
        return array(
            'UsersManager.checkPassword' => 'verifyPassword'
        );
    }

    public function getFactory()
    {
        return StaticContainer::get(ValidatorFactory::class);
    }

    public function verifyPassword($password) {
        $validators = $this->getFactory()->create(new SystemSettings());

        return $validators->validate($password);
    }
}

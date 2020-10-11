<?php

declare(strict_types=1);

namespace Piwik\Plugins\PasswordPolicyEnforcer;

use Piwik\Container\StaticContainer;
use Piwik\Plugin;
use Piwik\Plugins\PasswordPolicyEnforcer\Validators\ValidatorFactory;

/** @psalm-suppress UndefinedClass **/
class PasswordPolicyEnforcer extends Plugin
{
    public function registerEvents(): array
    {
        return [
            'UsersManager.checkPassword' => 'verifyPassword',
        ];
    }

    public function getFactory()
    {
        return StaticContainer::get(ValidatorFactory::class);
    }

    public function verifyPassword($password): bool
    {
        $validators = $this->getFactory()->create(new SystemSettings());

        return $validators->validate($password);
    }
}

<?php

declare(strict_types=1);

return [
    'Piwik\Plugins\PasswordPolicyEnforcer\Translator\Translator' => DI\autowire()->constructor(
        DI\get('Piwik\Translation\Translator')
    ),
    'Piwik\Plugins\PasswordPolicyEnforcer\Validators\PasswordValidator' => DI\autowire()->constructor(
        DI\get('Piwik\Plugins\PasswordPolicyEnforcer\Translator\Translator')
    ),
];

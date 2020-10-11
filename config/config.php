<?php

return array(
    'Piwik\Plugins\PasswordPolicyEnforcer\Translator\Translator' => DI\object()->constructor(
        DI\get('Piwik\Translation\Translator')
    ),
    'Piwik\Plugins\PasswordPolicyEnforcer\Validators\PasswordValidator' => DI\object()->constructor(
        DI\get('Piwik\Plugins\PasswordPolicyEnforcer\Translator\Translator')
    ),
);

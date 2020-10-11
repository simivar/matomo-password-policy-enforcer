<?php

namespace Piwik\Plugins\PasswordPolicyEnforcer\Translator;

interface TranslatorInterface
{
    public function translate(string $key, array $params): string;
}

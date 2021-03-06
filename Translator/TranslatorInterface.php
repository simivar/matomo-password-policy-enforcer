<?php

declare(strict_types=1);

namespace Piwik\Plugins\PasswordPolicyEnforcer\Translator;

interface TranslatorInterface
{
    /**
     * @param array<string|int> $params
     */
    public function translate(string $key, array $params): string;
}

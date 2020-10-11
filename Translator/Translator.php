<?php

declare(strict_types=1);

namespace Piwik\Plugins\PasswordPolicyEnforcer;

use Piwik\Plugins\PasswordPolicyEnforcer\Translator\TranslatorInterface;
use Piwik\Translation\Translator as MatomoTranslator;

final class Translator implements TranslatorInterface
{
    /**
     * @psalm-suppress UndefinedDocblockClass
     * @psalm-suppress PropertyNotSetInConstructor
     * @phpstan-ignore-next-line
     *
     * @var MatomoTranslator
     */
    private $translator;

    /**
     * @psalm-suppress UndefinedClass
     * @phpstan-ignore-next-line
     */
    public function __construct(MatomoTranslator $translator)
    {
        $this->translator = $translator;
    }

    /**
     * @param array<string|int> $params
     */
    public function translate(string $key, array $params): string
    {
        /**
         * @psalm-suppress UndefinedDocblockClass
         * @phpstan-ignore-next-line
         */
        return $this->translator->translate($key, $params);
    }
}

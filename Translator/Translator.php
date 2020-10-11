<?php

declare(strict_types=1);

namespace Piwik\Plugins\PasswordPolicyEnforcer;

use Piwik\Plugins\PasswordPolicyEnforcer\Translator\TranslatorInterface;
use Piwik\Translation\Translator as MatomoTranslator;

final class Translator implements TranslatorInterface
{
    /**
     * @psalm-suppress UndefinedDocblockClass
     *
     * @var MatomoTranslator
     */
    private $translator;

    /* @psalm-suppress UndefinedClass **/
    public function __construct(MatomoTranslator $translator)
    {
        $this->translator = $translator;
    }

    public function translate(string $key, array $params): string
    {
        /* @psalm-suppress UndefinedDocblockClass */
        return $this->translator->translate($key, $params);
    }
}

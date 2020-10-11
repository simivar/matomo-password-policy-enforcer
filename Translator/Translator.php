<?php

namespace Piwik\Plugins\PasswordPolicyEnforcer;

use Piwik\Plugins\PasswordPolicyEnforcer\Translator\TranslatorInterface;
use Piwik\Translation\Translator as MatomoTranslator;

final class Translator implements TranslatorInterface
{
    /** @var MatomoTranslator */
    private $translator;
    
    public function __construct(MatomoTranslator $translator)
    {
        $this->translator = $translator;
    }

    public function translate($key, $params)
    {
        return $this->translator->translate($key, $params);
    }
}
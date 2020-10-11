<?php

namespace Piwik\Plugins\PasswordPolicyEnforcer\Validators;

class ValidationException extends \Exception
{
    private $translationParams;

    public function __construct($message = "", $translationParams = array())
    {
        $this->translationParams = $translationParams;
        parent::__construct($message);
    }

    public function getTranslationParams()
    {
        return $this->translationParams;
    }
}

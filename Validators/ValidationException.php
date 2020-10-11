<?php

namespace Piwik\Plugins\PasswordPolicyEnforcer\Validators;

class ValidationException extends \Exception
{
    /**
     * @var array
     */
    private $translationParams;

    public function __construct(string $message = "", array $translationParams = array())
    {
        $this->translationParams = $translationParams;
        parent::__construct($message);
    }

    public function getTranslationParams(): array
    {
        return $this->translationParams;
    }
}

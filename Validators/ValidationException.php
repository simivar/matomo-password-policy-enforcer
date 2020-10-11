<?php

declare(strict_types=1);

namespace Piwik\Plugins\PasswordPolicyEnforcer\Validators;

class ValidationException extends \Exception
{
    /**
     * @var array
     */
    private $translationParams;

    public function __construct(string $message = '', array $translationParams = [])
    {
        $this->translationParams = $translationParams;
        parent::__construct($message);
    }

    public function getTranslationParams(): array
    {
        return $this->translationParams;
    }
}

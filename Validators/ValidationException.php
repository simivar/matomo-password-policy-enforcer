<?php

declare(strict_types=1);

namespace Piwik\Plugins\PasswordPolicyEnforcer\Validators;

class ValidationException extends \Exception
{
    /** @var array<string|int> */
    private $translationParams;

    /**
     * @param array<string|int> $translationParams
     */
    public function __construct(string $message = '', array $translationParams = [])
    {
        $this->translationParams = $translationParams;
        parent::__construct($message);
    }

    /**
     * @return array<string|int>
     */
    public function getTranslationParams(): array
    {
        return $this->translationParams;
    }
}

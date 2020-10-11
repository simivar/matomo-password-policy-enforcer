<?php

namespace Piwik\Plugins\PasswordPolicyEnforcer\Validators;

use Piwik\Plugins\PasswordPolicyEnforcer\Translator\TranslatorInterface;

class PasswordValidator implements ValidatorInterface
{
    /** @var ValidatorInterface[] */
    private $validators;

    /** @var TranslatorInterface */
    private $translator;

    public function __construct(TranslatorInterface $translator)
    {
        $this->translator = $translator;
    }

    public function addValidator(ValidatorInterface $validator): void
    {
        $this->validators[get_class($validator)] = $validator;
    }

    public function validate(string $value): bool
    {
        $violations = array();

        foreach ($this->validators as $validator) {
            try {
                $validator->validate($value);
            } catch (ValidationException $validationException) {
                $violations[] = $this->translator->translate(
                    $validationException->getMessage(),
                    $validationException->getTranslationParams()
                );
            }
        }

        if (!empty($violations)) {
            throw new ValidationException(implode(' ', $violations));
        }

        return true;
    }
}

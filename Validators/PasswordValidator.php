<?php

namespace Piwik\Plugins\PasswordPolicyEnforcer\Validators;

use Piwik\Plugins\PasswordPolicyEnforcer\Translator\TranslatorInterface;

class PasswordValidator implements ValidatorInterface
{
    /** @var ValidatorInterface[] */
    private $validators;

    /** @var TranslatorInterface */
    private $translator;

    /**
     * @param TranslatorInterface $translator
     */
    public function __construct(TranslatorInterface $translator)
    {
        $this->translator = $translator;
    }

    /**
     * @param ValidatorInterface $validator
     */
    public function addValidator($validator)
    {
        if (!($validator instanceof ValidatorInterface)) {
            return;
        }

        $this->validators[get_class($validator)] = $validator;
    }

    public function validate($value)
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

<?php

namespace Piwik\Plugins\PasswordPolicyEnforcer\Validators;

class PasswordValidator implements ValidatorInterface
{
    /** @var int */
    private $minLength;
    
    /** @var bool */
    private $isOneUppercaseRequired;
    
    /** @var bool */
    private $isOneLowercaseRequired;
    
    /** @var bool */
    private $isOneNumberRequired;
    
    /** @var bool */
    private $isOneSpecialCharacterRequired;
    
    public function __construct($minLength = 6, $isOneUppercaseRequired = false, $isOneLowercaseRequired = false, $isOneNumberRequired = false, $isOneSpecialCharacterRequired = false)
    {
        $this->minLength = (int) $minLength;
        $this->isOneUppercaseRequired = (bool) $isOneUppercaseRequired;
        $this->isOneLowercaseRequired = (bool) $isOneLowercaseRequired;
        $this->isOneNumberRequired = (bool) $isOneNumberRequired;
        $this->isOneSpecialCharacterRequired = (bool) $isOneSpecialCharacterRequired;
    }

    public function validate($value)
    {
        (new MinimumLengthValidator($this->minLength))->validate($value);

        if ($this->isOneUppercaseRequired) {
            (new UppercaseLetterValidator())->validate($value);
        }

        if ($this->isOneLowercaseRequired) {
            (new LowercaseLetterValidator())->validate($value);
        }

        if ($this->isOneNumberRequired) {
            (new NumberValidator())->validate($value);
        }

        if ($this->isOneSpecialCharacterRequired) {
            (new SpecialCharacterValidator())->validate($value);
        }
        
        return true;
    }
    
}

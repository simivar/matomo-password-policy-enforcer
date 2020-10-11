<?php

namespace Piwik\Plugins\PasswordPolicyEnforcer\tests\Unit\Validators;

use PHPUnit\Framework\TestCase;
use Piwik\Plugins\PasswordPolicyEnforcer\Validators\SpecialCharacterValidator;
use Piwik\Plugins\PasswordPolicyEnforcer\Validators\ValidationException;

/**
 * @group PasswordPolicy
 * @group PasswordPolicyTest
 * @group PasswordValidator
 * @group Password
 * @group Plugins
 */
class SpecialCharacterValidatorTest extends TestCase
{
    private $specialCharacterValidator;

    public function setUp(): void
    {
        $this->specialCharacterValidator = new SpecialCharacterValidator();
    }

    public function test_validate_throwExceptionWhenZeroUppercaseLetters(): void
    {
        $this->expectException(ValidationException::class);
        $this->expectExceptionMessage('PasswordPolicyEnforcer_ExceptionInvalidPasswordSpecialCharacterRequired');

        $this->specialCharacterValidator->validate('a');
    }

    public function test_validate_returnsTrueWhenAtLeastOneUppercaseLetter(): void
    {
        $this->assertTrue($this->specialCharacterValidator->validate('@'));
    }
}

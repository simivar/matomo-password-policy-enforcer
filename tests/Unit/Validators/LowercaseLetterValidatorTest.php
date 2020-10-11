<?php

namespace Piwik\Plugins\PasswordPolicyEnforcer\tests\Unit\Validators;

use PHPUnit\Framework\TestCase;
use Piwik\Plugins\PasswordPolicyEnforcer\Validators\LowercaseLetterValidator;
use Piwik\Plugins\PasswordPolicyEnforcer\Validators\ValidationException;

/**
 * @group PasswordPolicy
 * @group PasswordPolicyTest
 * @group PasswordValidator
 * @group Password
 * @group Plugins
 */
class LowercaseLetterValidatorTest extends TestCase
{
    private $lowercaseLetterValidator;

    public function setUp(): void
    {
        $this->lowercaseLetterValidator = new LowercaseLetterValidator();
    }

    public function test_validate_throwExceptionWhenZeroLowercaseLetters(): void
    {
        $this->expectException(ValidationException::class);
        $this->expectExceptionMessage('PasswordPolicyEnforcer_ExceptionInvalidPasswordLowercaseLetterRequired');

        $this->lowercaseLetterValidator->validate('SOMETESTPASSWORD');
    }

    public function test_validate_returnsTrueWhenAtLeastOneLowercaseLetter(): void
    {
        $this->assertTrue($this->lowercaseLetterValidator->validate('a'));
    }
}

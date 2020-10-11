<?php

declare(strict_types=1);

namespace Piwik\Plugins\PasswordPolicyEnforcer\tests\Unit\Validators;

use PHPUnit\Framework\TestCase;
use Piwik\Plugins\PasswordPolicyEnforcer\Validators\UppercaseLetterValidator;
use Piwik\Plugins\PasswordPolicyEnforcer\Validators\ValidationException;

/**
 * @group PasswordPolicy
 * @group PasswordPolicyTest
 * @group PasswordValidator
 * @group Password
 * @group Plugins
 */
class UppercaseLetterValidatorTest extends TestCase
{
    private $uppercaseLetterValidator;

    public function setUp(): void
    {
        $this->uppercaseLetterValidator = new UppercaseLetterValidator();
    }

    public function test_validate_throwExceptionWhenZeroUppercaseLetters(): void
    {
        $this->expectException(ValidationException::class);
        $this->expectExceptionMessage('PasswordPolicyEnforcer_ExceptionInvalidPasswordUppercaseLetterRequired');

        $this->uppercaseLetterValidator->validate('a');
    }

    public function test_validate_returnsTrueWhenAtLeastOneUppercaseLetter(): void
    {
        $this->assertTrue($this->uppercaseLetterValidator->validate('A'));
    }
}

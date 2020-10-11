<?php

declare(strict_types=1);

namespace Piwik\Plugins\PasswordPolicyEnforcer\tests\Unit\Validators;

use PHPUnit\Framework\TestCase;
use Piwik\Plugins\PasswordPolicyEnforcer\Validators\MinimumLengthValidator;
use Piwik\Plugins\PasswordPolicyEnforcer\Validators\ValidationException;

/**
 * @group PasswordPolicy
 * @group PasswordPolicyTest
 * @group PasswordValidator
 * @group Password
 * @group Plugins
 */
class MinimumLengthValidatorValidatorTest extends TestCase
{
    private $minimumLengthValidator;

    public function setUp(): void
    {
        $this->minimumLengthValidator = new MinimumLengthValidator();
    }

    public function test_validate_throwExceptionWhenPasswordTooShort(): void
    {
        $this->expectException(ValidationException::class);
        $this->expectExceptionMessage('UsersManager_ExceptionInvalidPassword');

        $this->minimumLengthValidator->validate('a');
    }

    public function test_validate_returnsTrueWhenLongerThenLimit(): void
    {
        $this->assertTrue($this->minimumLengthValidator->validate('somepassword'));
    }
}

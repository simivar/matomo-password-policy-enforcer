<?php

declare(strict_types=1);

namespace Piwik\Plugins\PasswordPolicyEnforcer\tests\Unit\Validators;

use PHPUnit\Framework\TestCase;
use Piwik\Plugins\PasswordPolicyEnforcer\Validators\NumberValidator;
use Piwik\Plugins\PasswordPolicyEnforcer\Validators\ValidationException;

/**
 * @group PasswordPolicy
 * @group PasswordPolicyTest
 * @group PasswordValidator
 * @group Password
 * @group Plugins
 */
class NumberValidatorTest extends TestCase
{
    private $numberValidator;

    public function setUp(): void
    {
        $this->numberValidator = new NumberValidator();
    }

    public function test_validate_throwExceptionWhenZeroNumbers(): void
    {
        $this->expectException(ValidationException::class);
        $this->expectExceptionMessage('PasswordPolicyEnforcer_ExceptionInvalidPasswordNumberRequired');

        $this->numberValidator->validate('a');
    }

    public function test_validate_returnsTrueWhenAtLeastOneNumber(): void
    {
        $this->assertTrue($this->numberValidator->validate('1'));
    }
}

<?php

namespace Piwik\Plugins\PasswordPolicyEnforcer\tests\Unit\Validators;

use Piwik\Plugins\PasswordPolicyEnforcer\Validators\NumberValidator;

/**
 * @group PasswordPolicy
 * @group PasswordPolicyTest
 * @group PasswordValidator
 * @group Password
 * @group Plugins
 */
class NumberValidatorTest extends \PHPUnit_Framework_TestCase
{
    private $numberValidator;

    public function setUp()
    {
        $this->numberValidator = new NumberValidator();
    }

    /**
     * @expectedException \Piwik\Plugins\PasswordPolicyEnforcer\Validators\ValidationException
     * @expectedExceptionMessage PasswordPolicyEnforcer_ExceptionInvalidPasswordNumberRequired
     */
    public function test_validate_throwExceptionWhenZeroNumbers()
    {
        $this->numberValidator->validate('a');
    }

    public function test_validate_returnsTrueWhenAtLeastOneNumber()
    {
        $this->assertTrue($this->numberValidator->validate('1'));
    }
}

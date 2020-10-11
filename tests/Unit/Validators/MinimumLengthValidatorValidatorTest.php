<?php

namespace Piwik\Plugins\PasswordPolicyEnforcer\tests\Unit\Validators;

use Piwik\Plugins\PasswordPolicyEnforcer\Validators\MinimumLengthValidator;

/**
 * @group PasswordPolicy
 * @group PasswordPolicyTest
 * @group PasswordValidator
 * @group Password
 * @group Plugins
 */
class MinimumLengthValidatorValidatorTest extends \PHPUnit_Framework_TestCase
{
    private $minimumLengthValidator;

    public function setUp()
    {
        $this->minimumLengthValidator = new MinimumLengthValidator();
    }

    /**
     * @expectedException \Piwik\Plugins\PasswordPolicyEnforcer\Validators\ValidationException
     * @expectedExceptionMessage UsersManager_ExceptionInvalidPassword
     */
    public function test_validate_throwExceptionWhenPasswordTooShort()
    {
        $this->minimumLengthValidator->validate('a');
    }

    public function test_validate_returnsTrueWhenLongerThenLimit()
    {
        $this->assertTrue($this->minimumLengthValidator->validate('somepassword'));
    }
}

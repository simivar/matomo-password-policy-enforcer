<?php

namespace Piwik\Plugins\PasswordPolicyEnforcer\tests\Unit\Validators;

use Piwik\Plugins\PasswordPolicyEnforcer\Validators\LowercaseLetterValidator;

/**
 * @group PasswordPolicy
 * @group PasswordPolicyTest
 * @group PasswordValidator
 * @group Password
 * @group Plugins
 */
class LowercaseLetterValidatorTest extends \PHPUnit_Framework_TestCase
{
    private $lowercaseLetterValidator;

    public function setUp()
    {
        $this->lowercaseLetterValidator = new LowercaseLetterValidator();
    }

    /**
     * @expectedException \Piwik\Plugins\PasswordPolicyEnforcer\Validators\ValidationException
     * @expectedExceptionMessage PasswordPolicyEnforcer_ExceptionInvalidPasswordLowercaseLetterRequired
     */
    public function test_validate_throwExceptionWhenZeroLowercaseLetters()
    {
        $this->lowercaseLetterValidator->validate('SOMETESTPASSWORD');
    }

    public function test_validate_returnsTrueWhenAtLeastOneLowercaseLetter()
    {
        $this->assertTrue($this->lowercaseLetterValidator->validate('a'));
    }
}

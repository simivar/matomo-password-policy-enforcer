<?php

namespace Piwik\Plugins\PasswordPolicyEnforcer\tests\Unit\Validators;

use Piwik\Plugins\PasswordPolicyEnforcer\Validators\LowercaseLetterValidator;
use Piwik\Plugins\PasswordPolicyEnforcer\Validators\UppercaseLetterValidator;

/**
 * @group PasswordPolicy
 * @group PasswordPolicyTest
 * @group PasswordValidator
 * @group Password
 * @group Plugins
 */
class UppercaseLetterValidatorTest extends \PHPUnit_Framework_TestCase
{
    private $uppercaseLetterValidator;

    public function setUp()
    {
        $this->uppercaseLetterValidator = new UppercaseLetterValidator();
    }

    /**
     * @expectedException \Piwik\Plugins\PasswordPolicyEnforcer\Validators\ValidationException
     * @expectedExceptionMessage PasswordPolicyEnforcer_ExceptionInvalidPasswordUppercaseLetterRequired
     */
    public function test_validate_throwExceptionWhenZeroUppercaseLetters()
    {
        $this->uppercaseLetterValidator->validate('a');
    }

    public function test_validate_returnsTrueWhenAtLeastOneUppercaseLetter()
    {
        $this->assertTrue($this->uppercaseLetterValidator->validate('A'));
    }
}

<?php

namespace Piwik\Plugins\PasswordPolicyEnforcer\tests\Unit\Validators;

use Piwik\Plugins\PasswordPolicyEnforcer\Validators\SpecialCharacterValidator;

/**
 * @group PasswordPolicy
 * @group PasswordPolicyTest
 * @group PasswordValidator
 * @group Password
 * @group Plugins
 */
class SpecialCharacterValidatorTest extends \PHPUnit_Framework_TestCase
{
    private $specialCharacterValidator;

    public function setUp()
    {
        $this->specialCharacterValidator = new SpecialCharacterValidator();
    }

    /**
     * @expectedException \Piwik\Plugins\PasswordPolicyEnforcer\Validators\ValidationException
     * @expectedExceptionMessage PasswordPolicyEnforcer_ExceptionInvalidPasswordSpecialCharacterRequired
     */
    public function test_validate_throwExceptionWhenZeroUppercaseLetters()
    {
        $this->specialCharacterValidator->validate('a');
    }

    public function test_validate_returnsTrueWhenAtLeastOneUppercaseLetter()
    {
        $this->assertTrue($this->specialCharacterValidator->validate('@'));
    }
}

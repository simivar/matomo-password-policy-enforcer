<?php

namespace Piwik\Plugins\PasswordPolicyEnforcer\tests\Unit\Validators;

use Piwik\Plugins\PasswordPolicyEnforcer\Validators\PasswordValidator;

/**
 * @group PasswordPolicy
 * @group PasswordPolicyTest
 * @group PasswordValidator
 * @group Password
 * @group Plugins
 */
class PasswordValidatorTest extends \PHPUnit_Framework_TestCase
{
    
    /** @var PasswordValidator */
    private $passwordValidator;
    
    public function setUp()
    {
        $this->passwordValidator = new PasswordValidator(15, true, true, true, true);
    }
    
    /**
     * @expectedException \Piwik\Plugins\PasswordPolicyEnforcer\Validators\ValidationException
     * @expectedExceptionMessage UsersManager_ExceptionInvalidPassword
     */
    public function test_validate_notLongEnough()
    {
        $this->passwordValidator->validate('test');
    }
    
    /**
     * @expectedException \Piwik\Plugins\PasswordPolicyEnforcer\Validators\ValidationException
     * @expectedExceptionMessage PasswordPolicyEnforcer_ExceptionInvalidPasswordUppercaseLetterRequired
     */
    public function test_validate_notOneUppercaseLetter()
    {
        $this->passwordValidator->validate('sometestpassword');
    }
    
    /**
     * @expectedException \Piwik\Plugins\PasswordPolicyEnforcer\Validators\ValidationException
     * @expectedExceptionMessage PasswordPolicyEnforcer_ExceptionInvalidPasswordLowercaseLetterRequired
     */
    public function test_validate_notOneLowercaseLetter()
    {
        $this->passwordValidator->validate('SOMETESTPASSWORD');
    }
    
    /**
     * @expectedException \Piwik\Plugins\PasswordPolicyEnforcer\Validators\ValidationException
     * @expectedExceptionMessage PasswordPolicyEnforcer_ExceptionInvalidPasswordNumberRequired
     */
    public function test_validate_notOneNumberLetter()
    {
        $this->passwordValidator->validate('someTestPassword');
    }
    
    /**
     * @expectedException \Piwik\Plugins\PasswordPolicyEnforcer\Validators\ValidationException
     * @expectedExceptionMessage PasswordPolicyEnforcer_ExceptionInvalidPasswordSpecialCharacterRequired
     */
    public function test_validate_notOneSpecialCharacter()
    {
        $this->passwordValidator->validate('someTestPassword19');
    }
    
    public function test_validate_validPasswords()
    {
        $this->passwordValidator->validate('someTest{Password19');
        $this->passwordValidator->validate('2%IVR4$Mw%8drTGJD!$IljgvFOr0@YWxRLb0QBt!G6Kf3');
        $this->passwordValidator->validate('somTestPsswrd!0');
    }
    
}

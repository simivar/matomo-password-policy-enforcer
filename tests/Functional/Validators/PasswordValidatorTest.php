<?php

namespace Piwik\Plugins\PasswordPolicyEnforcer\tests\Unit\Validators;

use Piwik\Plugins\PasswordPolicyEnforcer\Translator\TranslatorInterface;
use Piwik\Plugins\PasswordPolicyEnforcer\Validators\LowercaseLetterValidator;
use Piwik\Plugins\PasswordPolicyEnforcer\Validators\MinimumLengthValidator;
use Piwik\Plugins\PasswordPolicyEnforcer\Validators\NumberValidator;
use Piwik\Plugins\PasswordPolicyEnforcer\Validators\PasswordValidator;
use Piwik\Plugins\PasswordPolicyEnforcer\Validators\SpecialCharacterValidator;
use Piwik\Plugins\PasswordPolicyEnforcer\Validators\UppercaseLetterValidator;

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
        $translator = $this->getMockBuilder(TranslatorInterface::class)
            ->setMethods(['translate'])
            ->getMock();

        $translator->method('translate')->willReturnArgument(0);

        $this->passwordValidator = new PasswordValidator($translator);
    }
    
    /**
     * @expectedException \Piwik\Plugins\PasswordPolicyEnforcer\Validators\ValidationException
     * @expectedExceptionMessage UsersManager_ExceptionInvalidPassword
     */
    public function test_validate_notLongEnough()
    {
        $this->passwordValidator->addValidator(new MinimumLengthValidator());
        $this->passwordValidator->validate('test');
    }

    /**
     * @expectedException \Piwik\Plugins\PasswordPolicyEnforcer\Validators\ValidationException
     * @expectedExceptionMessage PasswordPolicyEnforcer_ExceptionInvalidPasswordUppercaseLetterRequired
     */
    public function test_validate_notOneUppercaseLetter()
    {
        $this->passwordValidator->addValidator(new UppercaseLetterValidator());
        $this->passwordValidator->validate('sometestpassword');
    }

    /**
     * @expectedException \Piwik\Plugins\PasswordPolicyEnforcer\Validators\ValidationException
     * @expectedExceptionMessage PasswordPolicyEnforcer_ExceptionInvalidPasswordLowercaseLetterRequired
     */
    public function test_validate_notOneLowercaseLetter()
    {
        $this->passwordValidator->addValidator(new LowercaseLetterValidator());
        $this->passwordValidator->validate('SOMETESTPASSWORD');
    }

    /**
     * @expectedException \Piwik\Plugins\PasswordPolicyEnforcer\Validators\ValidationException
     * @expectedExceptionMessage PasswordPolicyEnforcer_ExceptionInvalidPasswordNumberRequired
     */
    public function test_validate_notOneNumberLetter()
    {
        $this->passwordValidator->addValidator(new NumberValidator());
        $this->passwordValidator->validate('someTestPassword');
    }

    /**
     * @expectedException \Piwik\Plugins\PasswordPolicyEnforcer\Validators\ValidationException
     * @expectedExceptionMessage PasswordPolicyEnforcer_ExceptionInvalidPasswordSpecialCharacterRequired
     */
    public function test_validate_notOneSpecialCharacter()
    {
        $this->passwordValidator->addValidator(new SpecialCharacterValidator());
        $this->passwordValidator->validate('someTestPassword19');
    }

    public function test_validate_validPasswords()
    {
        $this->passwordValidator->addValidator(new MinimumLengthValidator());
        $this->passwordValidator->addValidator(new UppercaseLetterValidator());
        $this->passwordValidator->addValidator(new LowercaseLetterValidator());
        $this->passwordValidator->addValidator(new NumberValidator());
        $this->passwordValidator->addValidator(new SpecialCharacterValidator());

        $this->passwordValidator->validate('someTest{Password19');
        $this->passwordValidator->validate('2%IVR4$Mw%8drTGJD!$IljgvFOr0@YWxRLb0QBt!G6Kf3');
        $this->passwordValidator->validate('somTestPsswrd!0');
    }

}
